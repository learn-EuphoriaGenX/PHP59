<?php

$queries_array = [
  "users" => "
        CREATE TABLE IF NOT EXISTS `users` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(100) NOT NULL,
            `email` VARCHAR(100) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ",

  "admin" => "
        CREATE TABLE IF NOT EXISTS `admin` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(100) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ",

  "notes" => "
        CREATE TABLE IF NOT EXISTS `notes` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT NOT NULL,
            `thumbnail` VARCHAR(255) NOT NULL,
            `file_path` VARCHAR(255) NOT NULL,
            `uploaded_by` INT NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ",

  "saved_notes" => "
        CREATE TABLE IF NOT EXISTS `saved_notes` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `note_id` INT NOT NULL,
            `saved_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`note_id`) REFERENCES `notes`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    "
];

$host = "localhost";
$user = "root";
$password = null;
$database = "notesPedia59";
$port = 3306;

try {
  // Establish connection
  $conn = new mysqli($host, $user, $password, $database, $port);

  // Check connection
  if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
  }

  foreach ($queries_array as $table => $query) {
    if ($conn->query($query) === FALSE) {
      echo "❌ Error creating `$table`: " . $conn->error . "<br>";
    }
  }
} catch (\Throwable $err) {
  $_SESSION["error_msg"] = $err->getMessage();
}



?>