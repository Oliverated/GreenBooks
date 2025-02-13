<?php

require_once "db.inc.php";

session_start();


echo $book_id = $_GET["id"];  


// Step 1: Insert into `orders` table
$stmt = $conn->prepare("INSERT INTO `orders` (`user_id`, `book_id`, `status1`) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $_SESSION['user_id'], $book_id, $status1);
$status1 = "Pending"; 

$stmt->execute();
if ($stmt->execute()) {
    // Delete the item from the cart
    $deleteCart = $conn->prepare("DELETE FROM cart WHERE book_id = ?");
    $deleteCart->bind_param("i", $book_id);
    $deleteCart->execute();

    header("Location: ../users/cart.php?success=ordered");
    exit();
}

// $stmt->close();

// header("location: ../users/cart.php");

?>








