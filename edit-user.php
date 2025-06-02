<?php
require_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $originalUsername = $_POST['original_username'];
    $newUsername = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($newUsername && $role) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET username=?, password=?, role=? WHERE username=?");
            $stmt->bind_param("ssss", $newUsername, $hashedPassword, $role, $originalUsername);
        } else {
            $stmt = $conn->prepare("UPDATE users SET username=?, role=? WHERE username=?");
            $stmt->bind_param("sss", $newUsername, $role, $originalUsername);
        }

        $stmt->execute();
        header("Location: users-menu.php");
        exit;
    } else {
        echo "All fields except password are required.";
    }
}
?>