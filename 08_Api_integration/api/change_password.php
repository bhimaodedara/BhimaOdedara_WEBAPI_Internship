<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../db.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $email = trim($data['email'] ?? '');
    $old_password = trim($data['old_password'] ?? '');
    $new_password = trim($data['new_password'] ?? '');
} else {
    $email = trim($_POST['email'] ?? '');
    $old_password = trim($_POST['old_password'] ?? '');
    $new_password = trim($_POST['new_password'] ?? '');
}

if (empty($email) || empty($old_password) || empty($new_password)) {
    echo json_encode(["status" => false, "message" => "All fields are required"]);
    exit;
}

$q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND status='active'");

if (mysqli_num_rows($q) > 0) {
    $row = mysqli_fetch_assoc($q);
    if (password_verify($old_password, $row['password'])) {
        $hash_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update = mysqli_query($conn, "UPDATE users SET password='$hash_new_password' WHERE id=" . $row['id']);
        if ($update) {
            echo json_encode(["status" => true, "message" => "Password changed successfully"]);
        } else {
            echo json_encode(["status" => false, "message" => "Failed to change password", "error" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => false, "message" => "Invalid Old Password"]);
    }
} else {
    echo json_encode(["status" => false, "message" => "User Not Found or Inactive"]);
}
?>