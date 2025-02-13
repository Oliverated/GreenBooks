<?php

require_once "db.inc.php";
session_start();
// $user_id = $_SESSION['user_id']; 
$book_id = $_GET["id"];  

$stmt = $conn->prepare("INSERT INTO `order_items` (`order_id`, `book_id`, `quantity`, `price`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iisi", $order_id, $book_id, $quality, $price); 

$price = "250";
$status1 = "pending";

if ($stmt->execute()) {
    echo "Item added to cart successfully!";
} else {
    echo "Error: " . $stmt->error;
}
header("location: ../cart.php");
$stmt->close();


?>

