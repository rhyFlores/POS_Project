<?php
session_start();
require_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($username && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            header("Location: users-menu.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        

        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
