<?php
require_once "../includes/db.inc.php";
session_start();
// the guard
if (isset($_SESSION["email"])) {
    header("location: ../users/home.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/styles/auth.css">
    <title>Forget Password</title>
</head>

<body>
    <main>
        <form class="auth-form" action="" method="POST">
            <h5>Comfirmation Code</h5>

            <div>
                <input type="number" id="pin" placeholder="Pin..." name="pin">
            </div>
            <button id="loginBtn">Reset</button>
 
        <p class="orBlock">
          <a href="./sign_up.php">Sign Up</a> 
          <b>||</b>
          <a href="./login.php">Login</a> 
        </p> 
        <?php
// session_start(); // Start session at the beginning


// Ensure request is POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if pin is provided
    // if (!isset($_POST['pin']) || empty($_POST['pin'])) {
    //     die("OTP is required!");
    // }

    $pin = htmlspecialchars(trim($_POST['pin'])); // Keep OTP as a string

    // Ensure session email exists
    if (!isset($_SESSION["db_email"]) || empty($_SESSION["db_email"])) {
        die("Session email is missing!");
    }

    $email = $_SESSION["db_email"];

    // Prepare SQL statement to check OTP for the given email
    $stmt = $conn->prepare("SELECT otp FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if email exists
    if ($stmt->num_rows > 0) {
        // Fetch OTP from database
        $stmt->bind_result($db_otp);
        $stmt->fetch();

        echo "OTP Retrieved: " . $db_otp . "<br>";

        // Check if entered OTP matches the stored OTP
        if ($pin === $db_otp) {
            echo "Login successful!";
            // Redirect to dashboard or next step
            header("Location: dashboard.php"); // Change to your success page
            exit();
        } else {
            echo "Invalid OTP. Please try again.";
        }
    } else {
        echo "Email not found!";
    }

    $stmt->close();
}

$conn->close();
?>

        </form>


        
    </main>
</body>

</html>