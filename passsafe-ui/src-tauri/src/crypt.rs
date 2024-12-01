pub fn encrypt(str: String, key: String) -> String {
    // The str is encrypted using the key
    // the key is first converted to a number
    // the str is then for each character multiplied with the key
    // the result is then converted to a string

    let key = key.parse::<u64>().unwrap();
    let encrypted = str.chars().map(|c| format!("{}", c as u64 * key)).collect::<String>();
    encrypted
}

pub fn decrypt(str: String, key: String) -> String {
    // The str is decrypted using the key
    // the key is first converted to a number
    // the str is then for each character divided by the key
    // the result is then converted to a string

    let key = key.parse::<u64>().unwrap();
    let decrypted = str.chars().map(|c| format!("{}", c as u64 / key)).collect::<String>();
    decrypted
}