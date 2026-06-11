<?php

include 'auth.php'; 


$headers = getallheaders();
$token = str_replace("Bearer ", "", $headers['Authorization']);
$user_query = mysqli_query($conn, "SELECT id FROM users WHERE api_token='$token'");
$user_data = mysqli_fetch_assoc($user_query);
$user_id = $user_data['id'];


$data = json_decode(file_get_contents("php://input"), true);
if ($data) {
    $task_title = trim($data['task_title'] ?? '');
} else {
    $task_title = trim($_POST['task_title'] ?? '');
}

if (empty($task_title)) {
    echo json_encode(["status" => false, "message" => "Task title is required"]);
    exit;
}


$sql = "INSERT INTO tasks (user_id, task_title) VALUES ('$user_id', '$task_title')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode([
        "status" => true,
        "message" => "Task created successfully",
        "task_details" => [
            "assigned_user_id" => $user_id,
            "title" => $task_title
        ]
    ]);
} else {
    echo json_encode(["status" => false, "message" => "Failed to create task", "error" => mysqli_error($conn)]);
}
?>