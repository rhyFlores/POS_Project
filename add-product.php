<?php
require_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['name'];
    $productCategory = $_POST['category'];
    $productDesc = $_POST['description'];
    $productPrice = $_POST['price'];
    $productStock = $_POST['stock'];
    
    $target_dir = "uploads/"; // Directory where images will be uploaded
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Full path to the uploaded file
    $uploadOk = 1; // Flag to check if the upload is okay
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Get the file extension of the uploaded image

    $check = getimagesize($_FILES["image"]["tmp_name"]); // Check if the uploaded file is an image
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 2000000) { // Check if the file size is greater than 2MB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) { // Check if the file type is allowed
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) { // Attempt to move the uploaded file to the target directory

        $relative_path = $target_file; // Store the relative path of the uploaded image
       
        function generateRandomProductID($conn)// Generate a unique random product id
        {           
             $count="";
        do {

            $randomId = rand(1000000, 9999999); // range
            $stmt = $conn->prepare("SELECT COUNT(*) FROM suppliers WHERE supplierID = ?");
            $stmt->bind_param('i', $randomId);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
        } while ($count > 0);

        return $randomId;
     }

        $productID = generateRandomProductId($conn); // Call the function to generate a unique product ID
        $stmt = $conn->prepare("INSERT INTO products (productID, productName, productDesc, productPrice, productStock, ProductCategory, image) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdiss", $productID, $productName, $productDesc, $productPrice, $productStock, $productCategory, $relative_path);

        if ($stmt->execute()) {
            header('Location: products-menu.php');
            exit;
        } else {
            echo "Error inserting product: " . $stmt->error;
        }
    } else {
        echo "Sorry, there was an error uploading your image.";
    }
}
?>
