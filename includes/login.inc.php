<?php
require_once "db.inc.php";
session_start();
if (!isset($_SESSION["email"])) {
    header("location: ../auth/login.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Email = strtolower(htmlspecialchars(trim($_POST['email'])));
    $Pwd = trim($_POST['pwd']);

    $stmt = $conn->prepare("SELECT id, username, email, pwd FROM users WHERE email = ?");

    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->store_result();
    // input validation
    if (empty($Email) || empty($Pwd)) {
        header("Location: ../auth/login.php?error=One of this input is empty");
    } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../auth/login.php?error=Invalid Email!");
    } else if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $db_email, $db_pwd);
        $stmt->fetch();
        if (password_verify($Pwd, $db_pwd)) {
            $_SESSION["email"] = $db_email;
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            header("Location: ../users/home.php");
            exit();
        } else {
            header("Location: ./auth/login.php?error=Wrong password");
        }
    } else {
        header("Location: ./auth/login.php?error=No user found with that email!");
    }
    $stmt->close();
    $conn->close();
} else {
    die("Error: This page must be accessed via a POST request.");
}
?>
<!-- <a href="../users/home.php"></a> -->