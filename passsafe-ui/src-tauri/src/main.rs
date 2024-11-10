#![cfg_attr(not(debug_assertions), windows_subsystem = "windows")]

use std::fs::File;
use std::io::{Read, Write};
use aes::Aes256;
use block_modes::{BlockMode, Cbc};
use block_modes::block_padding::Pkcs7;
use rand::Rng;
use sha2::Digest;
use tauri::{AppHandle, Manager};

type Aes256Cbc = Cbc<Aes256, Pkcs7>;
const KEY: &[u8; 32] = b"24905218138413839434643453494321";

#[tauri::command]
fn loginas(email: String, password: String, uid: String) -> String {
  let combined = format!("{}{}{}", email, password, uid);

  let ascii_string: String = combined
    .chars()
    .map(|c| format!("{:02x}", c as u8))
    .collect();

  let mut hashed = ascii_string.clone();
  for _ in 0..96000 {
    hashed = format!("{:x}", sha2::Sha512::digest(hashed.as_bytes()));
  }

  hashed
}

#[tauri::command]
fn storekey(app_handle: AppHandle, key: String) -> String {
  if let Some(dir) = app_handle.path_resolver().app_data_dir() {
    let file_path = dir.join("key.enc");
    let iv: [u8; 16] = rand::thread_rng().gen();
    let cipher = Aes256Cbc::new_from_slices(KEY, &iv).unwrap();
    let ciphertext = cipher.encrypt_vec(key.as_bytes());
    let mut file = File::create(file_path).expect("Failed to create key file");
    file.write_all(&iv).expect("Failed to write IV");
    file.write_all(&ciphertext).expect("Failed to write encrypted key");
  }

  key
}

#[tauri::command]
fn getkey(app_handle: AppHandle) -> String {
  if let Some(dir) = app_handle.path_resolver().app_data_dir() {
    let file_path = dir.join("key.enc");
    let mut file = match File::open(file_path) {
      Ok(f) => f,
      Err(_) => return String::from("No key found"),
    };
    let mut iv = [0u8; 16];
    file.read_exact(&mut iv).expect("Failed to read IV");
    let mut ciphertext = Vec::new();
    file.read_to_end(&mut ciphertext).expect("Failed to read encrypted key");
    let cipher = Aes256Cbc::new_from_slices(KEY, &iv).unwrap();
    let decrypted_key = cipher.decrypt_vec(&ciphertext).expect("Decryption failed");
    return String::from_utf8(decrypted_key).expect("Invalid UTF-8");
  }

  String::from("No key found")
}

fn main() {
  tauri::Builder::default()
    .invoke_handler(tauri::generate_handler![loginas, storekey, getkey])
    .run(tauri::generate_context!())
    .expect("error while running tauri application");
}
