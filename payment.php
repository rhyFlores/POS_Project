<?php
session_start();

require 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $invoice = $_POST['invoiceNumber'];
    $total = floatval($_POST['totalPrice']);
    $items = json_decode($_POST['itemsData'], true);
    $date = date("Y-m-d");

    $qty = 0;
    foreach ($items as $i) {
        $qty += intval($i['quantity']);
    }

    $sql1 = "INSERT INTO sales (itemQuantity, totalSales, salesDate, invoiceNumber) 
             VALUES ($qty, $total, '$date', '$invoice')";

    if (!$conn->query($sql1)) {
        echo "Error saving to sales table: " . $conn->error;
        exit;
    }

    $saleID = $conn->insert_id;

    foreach ($items as $i) {
        $pid = intval($i['productID']);
        $q = intval($i['quantity']);
        $p = floatval($i['price']);

        $sql2 = "INSERT INTO salesItems (salesID, productID, quantity, price) 
                 VALUES ($saleID, $pid, $q, $p)";

        if (!$conn->query($sql2)) {
            echo "Error saving item to salesItems: " . $conn->error;
            exit;
        }
    }

    $_SESSION['receipts'][$invoice] = $items;
    echo "Payment Successful!";
}
?>
