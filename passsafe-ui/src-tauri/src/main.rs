#![cfg_attr(not(debug_assertions), windows_subsystem = "windows")]

use sha2::Digest;
// import ./crypt.rs functions
mod crypt;
use crate::crypt::{encrypt, decrypt};

#[tauri::command]
fn loginas(email: String, password: String, uid: String) -> String {
  let combined = format!("{}{}{}", email, password, uid);

  let ascii_string: String = combined
    .chars()
    .map(|c| format!("{:02x}", c as u8))
    .collect();

  let mut hashed = ascii_string.clone();
  for _ in 0..36000 {
    hashed = format!("{:x}", sha2::Sha512::digest(hashed.as_bytes()));
  }

  hashed
}

#[tauri::command]
fn encrypt_pw(password: String, key: String) -> String {
  // The password is 96'000 times encrypted (with Crypt) using the key

  let mut encrypted = password.clone();
  for _ in 0..96000 {
    encrypted = encrypt(encrypted, key.clone());
  }

  // Print encrypted to console
  println!("Encrypted: {}", encrypted);
  encrypted
}

#[tauri::command]
fn decrypt_pw(password: String, key: String) -> String {
  // The password is 96'000 times decrypted (with Crypt) using the key

  let mut decrypted = password.clone();
  for _ in 0..96000 {
    decrypted = decrypt(decrypted, key.clone());
  }

  // Print decrypted to console
  println!("Decrypted: {}", decrypted);
  decrypted
}

fn main() {
  tauri::Builder::default()
    .invoke_handler(tauri::generate_handler![loginas,encrypt_pw,decrypt_pw])
    .run(tauri::generate_context!())
    .expect("error while running tauri application");
}
