<?php
include('../common/db.php');
session_start();
//  user registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_register_btn'])) {
    $name = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['useremail']);
    $password = htmlspecialchars($_POST['userpassword']);

    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['error_msg'] = 'Please fill All the fields';
        header("Location: ../?register=true");
    } else {
        $hassed_password = password_hash($password, PASSWORD_DEFAULT); // password hash
        try {
            $stmt = $conn->prepare("INSERT into users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $name, $email, $hassed_password);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $_SESSION['success_msg'] = $name . ' user Registered Successfully!';
                header('Location: ../?login=true"');
            } else {
                $_SESSION['error_msg'] = 'Something Went Wrong😥';
                header("Location: ../?register=true");
            }
        } catch (\Throwable $err) {
            $_SESSION["error_msg"] = $err->getMessage();
            header("Location: ../?register=true");
        }
    }
    $conn->close();
}

//  user login
//  Admin Registration
//  admin Login


?>