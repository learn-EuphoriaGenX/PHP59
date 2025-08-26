<?php
// if tables not created, run the following SQL queries:

$userQuery = "CREATE TABLE IF NOT EXISTS `notesPedia59`.`users` (
        `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `name` varchar(100) NOT NULL,
        `email` varchar(100) NOT NULL UNIQUE,
        `password` varchar(255) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$adminQuery = "CREATE TABLE IF NOT EXISTS `notesPedia59`.`admin` (
        `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `username` varchar(100) NOT NULL UNIQUE,
        `password` varchar(255) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$notesQeury = "CREATE TABLE IF NOT EXISTS `notesPedia59`.`notes` (
        `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `thumbnail` varchar(255) NOT NULL,
        `file_path` varchar(255) NOT NULL,
        `uploaded_by` int NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$savedNotesQuery = "CREATE TABLE IF NOT EXISTS `notesPedia59`.`saved_notes` (
        `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `user_id` int NOT NULL,
        `note_id` int NOT NULL,
        `saved_at` timestamp NOT NULL DEFAULT current_timestamp(),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (note_id) REFERENCES notes(id) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";


// Database configuration
$host = "localhost";
$user = "root";
$password = null;
$database = "notesPedia59";
$port = 3306;

$conn = new mysqli($host, $user, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $result = mysqli_query($conn, $userQuery);
    $result = mysqli_query($conn, $adminQuery);
    $result = mysqli_query($conn, $notesQeury);
    $result = mysqli_query($conn, $savedNotesQuery);

    if ($result === false) {
        echo "Error creating tables: " . mysqli_error($conn);
    }
}


?>