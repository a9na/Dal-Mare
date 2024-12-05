<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Here you should validate the user credentials with your database
// For example:
if ($username === 'admin' && $password === 'admin123') {
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = 'admin';  // For demonstration, change to database user type
    echo json_encode(['success' => true, 'username' => $username, 'user_type' => 'admin']);
} else if ($username === 'user' && $password === 'user123') {
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = 'user';
    echo json_encode(['success' => true, 'username' => $username, 'user_type' => 'user']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}
?>
