<?php
session_start();
require_once "db.inc.php";
if (!isset($_SESSION["email"])) {
    header("location: ../auth/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

// insert
$Username = htmlspecialchars($_POST['username']);
$Fullname = htmlspecialchars($_POST['name']);
$Email = strtolower(htmlspecialchars(trim($_POST['email'])));
$Pwd = htmlspecialchars($_POST['pwd']);


// // Check if username already exists
// $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
// $stmt->bind_param("s", $Username);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows > 0) {
//     // Redirect with an error message
//     header("Location: signup.php?error=Username already taken");
//     exit();
// }


// if ($stmt->execute()) {
//     header("location: ../auth/login.php");
//     exit();
// } else {
//     // echo "Error deleting book from cart: " . $stmt->error;
//     header("Location: ../auth/sign_up.php?error=Something is wrong");
//     exit();
// }


$option = ['pwdlen' => 10 ];
$hashpwd = password_hash($Pwd, PASSWORD_BCRYPT, $option); 

$stmt = $conn->prepare("INSERT INTO users(username, fullname, email, pwd) VALUES(?,?,?,?)");
$stmt->bind_param("ssss", $Username, $Fullname, $Email, $hashpwd);

if (empty($Username) || empty($Fullname) || empty($Email) || empty($Pwd)) {
    header("Location: ../auth/sign_up.php?error=Enter all inputs");
} else if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../auth/sign_up.php?error=Invalid Email!");
} 

if ($stmt->execute()) {
    // Redirect to cart page after deletion
    header("Location:../auth/login.php ");
    exit();
} else {
    echo "Error deleting book from cart: " . $stmt->error;
}

}

$conn->close();
?>