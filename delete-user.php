<?php
require_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = ($_POST['username']);

    $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        echo "success";
    } else {
        http_response_code(500);
        echo "Error deleting user.";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo "Invalid request.";
}
?>
