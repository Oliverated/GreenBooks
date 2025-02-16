<?php
require_once "../includes/db.inc.php";
session_start();
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require('vendor/autoload.php');

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                     // Enable SMTP authentication
    $mail->Username = 'victorlodoliver@gmail.com';                   // Your Gmail address
    $mail->Password = 'ximz qzyq sxqx qfeg';                      // Your Gmail App Password
    $mail->SMTPSecure = "tls";         // Enable TLS encryption
    $mail->Port = 587;                                          // TCP port for TLS connection
    // Recipients
    $mail->setFrom('oratedcodes@gmail.com', 'victor oliver');        // Sender's email and name
    $mail->addAddress('victorlodoliver@gmail.com', 'Gift');     // Recipient's email and name

    // otp setup
    $otp = random_int(1000, 9999);
    echo "Your OTP is: " . $otp;

    // $mail->Body("Your OTP is:  . $otp");

// Sanitize and validate email input
if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = strtolower(htmlspecialchars(trim($_POST['email'])));
} else {
    die("Invalid email address!");
}

// Check if the email exists in the database
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Email exists, update OTP
    $stmt->close(); // Close previous statement before executing a new one

    $update_stmt = $conn->prepare("UPDATE users SET otp = ? WHERE email = ?");
    $update_stmt->bind_param("ss", $otp, $email);

    if ($update_stmt->execute()) {
        echo "OTP has been sent to your email!";
        header("location: val_code.php"); // Redirect to validation page
        $_SESSION["db_email"] = $email;
        exit();
    } else {
        echo "Error updating OTP: " . $update_stmt->error;
    }

    $update_stmt->close();
} else {
    echo "Email not found in our records.";
}

$conn->close();

$stmt->close();
$conn->close();




    // Email content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = 'Victor L. Oliver';
    $mail->Body = "Your OTP is: " . $otp;;


    // Send the email
    $mail->send();
    echo 'Message has been sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>