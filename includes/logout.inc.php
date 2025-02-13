<?php
session_start();
header("location: ../auth/login.php");
session_destroy();
exit;
?>