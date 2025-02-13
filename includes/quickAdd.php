<?php
require_once "db.inc.php";
session_start();

$book_id = $_GET["id"];

$stmt = $conn->prepare("INSERT INTO `cart` (`user_id`, `book_id`) VALUES (?, ?)");

$stmt->bind_param("ii", $_SESSION['user_id'], $book_id); // "ii" means both values are integers

if ($stmt->execute()) {
    echo "Item added to cart successfully!";
} else {
    echo "Error executing query: " . $stmt->error;
}

$stmt->close();

header("Location: ../users/home.php");
exit();
?>