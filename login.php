<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);

$username = $data["username"];
$password = $data["password"];

$users = json_decode(file_get_contents("users.json"), true);

if (!isset($users[$username]) || !password_verify($password, $users[$username])) {
    echo json_encode(["success" => false, "message" => "Invalid username or password!"]);
    exit;
}

// Save login session
$_SESSION["user"] = $username;
echo json_encode(["success" => true, "message" => "Login successful!", "user" => $username]);
?>
