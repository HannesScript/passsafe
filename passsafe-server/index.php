<?php
// Initialize the database
require_once 'db.php';

// create_user('jouhn.doe@gmail.com', ['name' => 'John Doe']);
// create_password(1, 'facebook', ['username' => 'john.doe', 'password' => 'b37roih!']);
// create_password(1, 'twitter', ['username' => 'john.doe', 'password' => '5zrhr4']);
// create_password(1, 'instagram', ['username' => 'john.doe', 'password' => 'erg435!']);
// create_password(1, 'linkedin', ['username' => 'john.doe', 'password' => 'g34345z4hg345!']);
// create_password(1, 'github', ['username' => 'john.doe', 'password' => 'bg347wl834!']);

// echo json_encode(get_all_passwords_servicename_sorted(1));


//////////////////////////////////////////
// Request handling
//////////////////////////////////////////

require 'vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Creating
$app->post("/createuser", function (Request $request, Response $response) {
    $data = $request->getParsedBody();

    if (isset($data['email']) && isset($data['data'])) {
        $email = $data['email'];
        $udata = $data['data'];
        $user = create_user($email, $udata);

        if (!$user) {
            return $response->withStatus(400);
        }

        $response->getBody()->write((string)$user);
        return $response->withHeader('Content-Type', 'application/text');
    } else {
        $streamFactory = new StreamFactory();
        $errorStream = $streamFactory->createStream("Missing email or data");

        return $response->withStatus(400)->withBody($errorStream);
    }
});


$app->post("/createpassword", function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $uid = $data['uid'];
    $servicename = $data['servicename'];
    $pwdata = $data['data'];
    create_password($uid, $servicename, $pwdata);
    return $response->withStatus(200);
});

// Updating
$app->post("/updateuser", function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $uid = $data['uid'];
    $udata = $data['data'];
    update_user($uid, json_decode($udata));
    return $response->withStatus(200);
});

$app->post("/updatepassword", function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $uid = $data['uid'];
    $servicename = $data['servicename'];
    $pwdata = $data['data'];
    update_password($uid, $servicename, json_decode($pwdata));
    return $response->withStatus(200);
});

// Deleting
$app->post("/deleteuser", function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $uid = $data['uid'];
    delete_user($uid);
    return $response->withStatus(200);
});

$app->get("/deletepassword", function (Request $request, Response $response) {
    $data = $request->getQueryParams();
    $uid = $data['uid'];
    $servicename = $data['servicename'];
    delete_password($uid, $servicename);
    return $response->withStatus(200);
});

// Getting
$app->get("/getallpasswords", function (Request $request, Response $response) {
    $uid = $request->getQueryParams()['uid'];
    $passwords = get_all_passwords_servicename_sorted($uid);
    $response->getBody()->write(json_encode($passwords));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get("/getuser", function (Request $request, Response $response) {
    $uid = $request->getQueryParams()['uid'];
    $user = get_user($uid);
    $response->getBody()->write(json_encode($user));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get("/getpassword", function (Request $request, Response $response) {
    $uid = $request->getQueryParams()['uid'];
    $servicename = $request->getQueryParams()['servicename'];
    $password = get_password($uid, $servicename);
    if(!$password) {
        $response = $response->withStatus(400);
        $streamFactory = new StreamFactory();
        $response = $response->withBody($streamFactory->createStream("Password or User ID not found"));
        return $response;
    }
    $response->getBody()->write(json_encode($password));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
