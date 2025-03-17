<?php
$data = json_decode(file_get_contents("php://input"), true);

$username = $data["username"];
$password = $data["password"];

if (!$username || !$password) {
    echo json_encode(["success" => false, "message" => "Username and password required!"]);
    exit;
}

// Load existing users
$users = json_decode(file_get_contents("users.json"), true);

// Check if user exists
if (isset($users[$username])) {
    echo json_encode(["success" => false, "message" => "Username already exists!"]);
    exit;
}

// Save new user (⚠ Insecure: Hash the password using password_hash() for real use)
$users[$username] = password_hash($password, PASSWORD_DEFAULT);
file_put_contents("users.json", json_encode($users));

echo json_encode(["success" => true, "message" => "Registration successful!"]);
?>
