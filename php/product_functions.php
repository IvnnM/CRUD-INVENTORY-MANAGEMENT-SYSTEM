<?php

// Include your database connection file
include '../connect.php';

// Function to add a product
function addProduct($name, $quantity, $price) {
    global $conn;
    $sql = "INSERT INTO `product` (`Product_Name`, `Quantity`, `Price`) VALUES ('$name', '$quantity', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

// Function to update a product
function updateProduct($id, $name, $quantity, $price) {
    global $conn;
    $sql = "UPDATE `product` SET `Product_Name`='$name', `Quantity`='$quantity', `Price`='$price' WHERE `Product_ID`='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Function to delete a product
function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM `product` WHERE `Product_ID`='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Function to add stock
function addStock($productId, $quantityToAdd) {
    global $conn;
    // Fetch current quantity from the database
    $result = $conn->query("SELECT `Quantity` FROM `product` WHERE `Product_ID`='$productId'");
    $row = $result->fetch_assoc();
    $currentQuantity = $row['Quantity'];

    // Calculate new quantity
    $newQuantity = $currentQuantity + $quantityToAdd;

    // Update the quantity in the database
    $updateSql = "UPDATE `product` SET `Quantity`='$newQuantity' WHERE `Product_ID`='$productId'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Stock added successfully.";
    } else {
        echo "Error adding stock: " . $conn->error;
    }
}
// Function to subtract stock
function subtractStock($id, $quantityToSubtract) {
    global $conn;
    $sql = "UPDATE `product` SET `Quantity` = `Quantity` - '$quantityToSubtract' WHERE `Product_ID`='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Stock subtracted successfully.";
    } else {
        echo "Error subtracting stock: " . $conn->error;
    }
}
// Function to checkout
function checkout($productId, $quantityToCheckout, $customerName) {
    global $conn;

    // Insert a record into the `transacts` table
    $timestamp = date("Y-m-d H:i:s");
    $insertSql = "INSERT INTO `transacts` (`product_id`, `customer_name`, `quantity`, `timestamp`) VALUES ('$productId', '$customerName', '$quantityToCheckout', '$timestamp')";

    if ($conn->query($insertSql) === TRUE) {
        echo "Checkout successful.";
    } else {
        echo "Error inserting record into transacts table: " . $conn->error;
    }
}


?>
