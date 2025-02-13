<?php
require_once "db.inc.php";
$id = intval($_GET["id"]); 

$conn->query("DELETE FROM orders WHERE book_id = $id");

$conn->query("DELETE FROM cart WHERE book_id = $id");

$sql = "DELETE FROM books WHERE id = $id";
$result = $conn->query($sql);      

header("location: ../admin/book_man.php");
$conn->close();
?>
