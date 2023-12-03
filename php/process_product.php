<?php
// Start the session
session_start();

// Include your database connection file
include '../connect.php';

// Include the functions file
include './product_functions.php';

// Check if the form is submitted for adding a new product
if (isset($_POST['addProduct'])) {
    // Retrieve form data
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Call the addProduct function
    addProduct($productName, $quantity, $price);

    // Set success message
    $_SESSION['success_message'] = 'Product added successfully.';
}

// Check if the form is submitted for updating a product
if (isset($_POST['updateProduct'])) {
    // Retrieve form data
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Call the updateProduct function
    updateProduct($productId, $productName, $quantity, $price);

    // Set success message
    $_SESSION['success_message'] = 'Product updated successfully.';
}

// Check if the form is submitted for deleting a product
if (isset($_POST['deleteProduct'])) {
    // Retrieve form data
    $productId = $_POST['productId'];

    // Call the deleteProduct function
    deleteProduct($productId);

    // Set success message
    $_SESSION['success_message'] = 'Product deleted successfully.';
}

// Check if the form is submitted for adding stock
if (isset($_POST['addStock'])) {
    // Retrieve form data
    $productId = $_POST['productId'];
    $quantityToAdd = $_POST['quantity'];

    // Call the addStock function
    addStock($productId, $quantityToAdd);

    // Set success message
    $_SESSION['success_message'] = 'Stock added successfully.';
}

// Check if the form is submitted for subtracting stock (checkout)
if (isset($_POST['subtractStock'])) {
    // Retrieve form data
    $productId = $_POST['productId'];
    $quantityToSubtract = $_POST['quantity'];
    $quantityToCheckout = $_POST['quantity'];
    $customerName = $_POST['customerName'];
    // Call the subtractStock function
    subtractStock($productId, $quantityToSubtract);
    checkout($productId, $quantityToCheckout, $customerName);
    // Set success message
    $_SESSION['success_message'] = 'Stock subtracted successfully.';
}


// Close the database connection
$conn->close();

// Redirect back to the main page or wherever you want after processing
header("Location: ../V2index.php");
exit();
?>
