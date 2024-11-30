#![cfg_attr(not(debug_assertions), windows_subsystem = "windows")]

use sha2::Digest;

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

fn main() {
  tauri::Builder::default()
    .invoke_handler(tauri::generate_handler![loginas])
    .run(tauri::generate_context!())
    .expect("error while running tauri application");
}
