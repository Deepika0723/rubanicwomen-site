<?php
include 'config.php';

// Dummy user_id for now
$user_id = 1;

$product_name = $_POST['product_name'];
$price = $_POST['price'];
$image = $_POST['image'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO cart (product_name, price, image, quantity, user_id)
        VALUES ('$product_name', '$price', '$image', '$quantity', '$user_id')";

if (mysqli_query($conn, $sql)) {
    header("Location: cart.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
