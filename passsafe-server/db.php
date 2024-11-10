<?php
$db_path = "db/";
$db_users = "{$db_path}users/";
$db_passwords = "{$db_path}passwords/";
$user_id_file = "{$db_path}last_uid.txt";

// Create directories if they don't exist
if (!is_dir($db_users)) {
    mkdir($db_users, 0777, true);
}

if (!is_dir($db_passwords)) {
    mkdir($db_passwords, 0777, true);
}

function get_user($uid) {
    global $db_users;
    $user_file = "{$db_users}u_{$uid}.json";
    if (file_exists($user_file)) {
        return json_decode(file_get_contents($user_file), true);
    } else {
        return null;
    }
}

function get_password($uid, $servicename) {
    global $db_passwords;
    $password_file = "{$db_passwords}{$uid}_{$servicename}.json";
    if (file_exists($password_file)) {
        return json_decode(file_get_contents($password_file), true);
    } else {
        return null;
    }
}

function create_user($useremail, $userdata) {
    global $db_users, $user_id_file;

    // Open the UID file and lock it
    $fp = fopen($user_id_file, 'c+');
    if (flock($fp, LOCK_EX)) {
        // Read the last UID and increment
        $last_uid = intval(stream_get_contents($fp) ?: 0);
        $uid = $last_uid + 1;

        // Write the new UID back to the file
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, $uid);
        fflush($fp); // Flush output before releasing the lock
        flock($fp, LOCK_UN);
        fclose($fp);

        // Create the user file
        $user_file = "{$db_users}u_{$uid}.json";
        $user = ['useremail' => $useremail, 'uid' => $uid, 'data' => $userdata];
        file_put_contents($user_file, json_encode($user));
        return $uid;
    } else {
        fclose($fp);
        return false; // Could not lock the file
    }
}

function create_password($uid, $servicename, $pwdata) {
    global $db_passwords;
    $password_file = "{$db_passwords}{$uid}_{$servicename}.json";
    $password_data = ['uid' => $uid, 'servicename' => $servicename, 'data' => $pwdata];
    file_put_contents($password_file, json_encode($password_data));
}

function update_user($uid, $userdata) {
    global $db_users;
    $user_file = "{$db_users}u_{$uid}.json";
    $user = get_user($uid);
    if ($user) {
        $user['data'] = $userdata;
        file_put_contents($user_file, json_encode($user));
    }
}

function update_password($uid, $servicename, $pwdata) {
    global $db_passwords;
    $password_file = "{$db_passwords}{$uid}_{$servicename}.json";
    $password_data = get_password($uid, $servicename);
    if ($password_data) {
        $password_data['data'] = $pwdata;
        file_put_contents($password_file, json_encode($password_data));
    }
}

function delete_user($uid) {
    global $db_users;
    global $db_passwords;
    $user_file = "{$db_users}u_{$uid}.json";
    if (file_exists($user_file)) {
        unlink($user_file);
        // Delete all passwords associated with this user
        $password_files = glob("{$db_passwords}{$uid}_*.json");
        foreach ($password_files as $password_file) {
            unlink($password_file);
        }
    }
}

function delete_password($uid, $servicename) {
    global $db_passwords;
    $password_file = "{$db_passwords}{$uid}_{$servicename}.json";
    if (file_exists($password_file)) {
        unlink($password_file);
    }
}

function get_all_passwords_servicename_sorted($uid) {
    global $db_passwords;
    $password_files = glob("{$db_passwords}{$uid}_*.json");
    $passwords = array();
    foreach ($password_files as $password_file) {
        $password_data = json_decode(file_get_contents($password_file), true);
        $servicename = $password_data['servicename'];
        // Add $servicename to the $passwords array
        array_push($passwords, $servicename);
    }
    ksort($passwords);
    return $passwords;
}