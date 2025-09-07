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
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_login_btn'])) {
    $email = htmlspecialchars($_POST['useremail']);
    $password = htmlspecialchars($_POST['userpassword']);

    if (empty($email) || empty($password)) {
        $_SESSION['error_msg'] = 'Please fill All the fields';
        header("Location: ../?login=true");
    } else {
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? ");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (!password_verify($password, $row['password'])) {
                    $_SESSION['error_msg'] = 'Passsword Invalid';
                    header('Location: ../?login=true');
                } else {
                    $_SESSION['isLoggedIn'] = 'true';
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['userType'] = 'user';
                    $_SESSION["success_msg"] = " User Logged In Successfully!";
                    header("Location: ../?notes=true");
                }

            } else {
                $_SESSION["error_msg"] = " No User Found with This Email: " . $email;
                header("Location: ../?login=true");
            }

        } catch (\Throwable $err) {
            $_SESSION["error_msg"] = $err->getMessage();
            header("Location: ../?login=true");
        }
    }
    $conn->close();
}
//  Admin Registration
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_register_btn'])) {
    $name = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($name) || empty($password)) {
        $_SESSION['error_msg'] = 'Please fill All the fields';
        header("Location: ../?secret=true");
    } else {
        $hassed_password = password_hash($password, PASSWORD_DEFAULT); // password hash
        try {
            $stmt = $conn->prepare("INSERT into admin (username, password) VALUES (?, ?)");
            $stmt->bind_param('ss', $name, $hassed_password);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $_SESSION['success_msg'] = $name . ' Admin Registered Successfully!';
                header('Location: ../?adminLogin=true"');
            } else {
                $_SESSION['error_msg'] = 'Something Went Wrong😥';
                header(header: "Location: ../?secret=true");
            }
        } catch (\Throwable $err) {
            $_SESSION["error_msg"] = $err->getMessage();
            header("Location: ../?secret=true");
        }
    }
    $conn->close();
}
//  admin Login
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_login_btn'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error_msg'] = 'Please fill All the fields';
        header("Location: ../?adminLogin=true");
    } else {
        try {
            $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? ");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (!password_verify($password, $row['password'])) {
                    $_SESSION['error_msg'] = 'Passsword Invalid';
                    header('Location: ../?adminLogin=true');
                } else {
                    $_SESSION['isLoggedIn'] = 'true';
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['userType'] = 'admin';
                    $_SESSION["success_msg"] = " Admin Logged In Successfully!";
                    header("Location: ../?dashboard=true");
                }

            } else {
                $_SESSION["error_msg"] = " No Admin Found with This Username: " . $username;
                header("Location: ../?adminLogin=true");
            }

        } catch (\Throwable $err) {
            $_SESSION["error_msg"] = $err->getMessage();
            header("Location: ../?adminLogin=true");
        }
    }
    $conn->close();
}


?>