<?php

require_once "db.inc.php";

$id = $_GET["id"];
$sql = "DELETE FROM users WHERE id = $id";
$result = $conn->query($sql);      
                   
header("location: ../admin/man_users.php");

$conn->close();

?>
