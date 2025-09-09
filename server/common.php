<?php
include('../common/db.php');
session_start();
//  upload New Notes
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_btn'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $thumbnail = $_FILES['thumbnail'];
    $zip_file = $_FILES['zip_file'];

    if (empty($title) || empty($description) || empty($thumbnail) || empty($zip_file)) {
        $_SESSION['error_msg'] = 'Please fill All the fields';
        header("Location: ../?upload=true");
    } else {
        // for thumbnail
        $new_thumbnail_filename = uniqid() . $thumbnail['name'];
        $thumbnail_tempfile = $thumbnail['tmp_name'];
        $thumbnail_folder = "uploads/thumb/" . $new_thumbnail_filename;

        // for zip file
        $new_zip_filename = uniqid() . $zip_file['name'];
        $zip_tempfile = $zip_file['tmp_name'];
        $zip_folder = 'uploads/zips/' . $new_zip_filename;

        // upload file 
        $is_thumb_successfully_upload = move_uploaded_file($thumbnail_tempfile, $thumbnail_folder);
        $is_zip_successfully_upload = move_uploaded_file($zip_tempfile, $zip_folder);

        try {
            if ($is_thumb_successfully_upload && $is_zip_successfully_upload) {
                $user_id = $_SESSION['id'];
                $stmt = $conn->prepare("INSERT into notes (title, description, thumbnail, file_path, uploaded_by) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('ssssi', $title, $description, $new_thumbnail_filename, $new_zip_filename, $user_id);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $_SESSION['success_msg'] = ' New Notes Addedd Successfully!';
                    header('Location: ../?notes=true"');
                } else {
                    $_SESSION['error_msg'] = 'Something Went Wrong😥';
                    header("Location: ../?upload=true");
                }
            } else {
                $_SESSION["error_msg"] = "Unable to upload File and Zip!";
                header("Location: ../?upload=true");
            }
        } catch (\Throwable $err) {
            $_SESSION["error_msg"] = $err->getMessage();
            header("Location: ../?upload=true");
        }
    }
    $conn->close();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saved_btn'])) {
    $user_id = $_SESSION['id'];
    $note_id = $_POST['note_id'];

    if (empty($note_id) || empty($user_id)) {
        $_SESSION['error_msg'] = 'You are Not Logged In';
        header('Location: ../?details=' . $note_id);
    } else {
        try {
            $stmt = $conn->prepare("SELECT * FROM saved_notes WHERE user_id = ? AND note_id = ?");
            $stmt->bind_param("ii", $user_id, $note_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $_SESSION['error_msg'] = 'Already Saved!';
                header('Location: ../?details=' . $note_id);
            } else {
                $stmt = $conn->prepare('INSERT into saved_notes (user_id, note_id) VALUES (?, ?)');
                $stmt->bind_param('ii', $user_id, $note_id);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $_SESSION['success_msg'] = ' Notes Addedd To Saved!';
                    header('Location: ../?details=' . $note_id);
                } else {
                    $_SESSION['error_msg'] = 'Something Went Wrong😥';
                    header('Location: ../?details=' . $note_id);
                }
            }
        } catch (\Throwable $err) {
            $_SESSION["error_msg"] = $err->getMessage();
            header('Location: ../?details=' . $note_id);
        }
    }
}



?>