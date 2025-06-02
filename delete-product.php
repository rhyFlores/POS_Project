<?php
require_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productID'])) {
    $productID = intval($_POST['productID']);

    $stmt = $conn->prepare("DELETE FROM products WHERE productID = ?");
    $stmt->bind_param("i", $productID);

    if ($stmt->execute()) {
        echo "success";
    } else {
        http_response_code(500);
        echo "Error deleting product.";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo "Invalid request.";
}
