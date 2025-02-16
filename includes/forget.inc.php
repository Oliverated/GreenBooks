<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If installed via Composer

$mail = new PHPMailer(true); // Enable exceptions

try {
    // Server settings
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com'; // SMTP server (Gmail example)
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'your-email@gmail.com'; // Your email  
    $mail->Password   = 'your-email-password'; // Your email password or app password  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type  
    $mail->Port       = 587; // SMTP port  

    // Recipients
    $mail->setFrom('your-email@gmail.com', 'Your Name');  
    $mail->addAddress('recipient@example.com', 'Recipient Name');  

    // Content
    $mail->isHTML(true); // Set email format to HTML  
    $mail->Subject = 'Test Email';  
    $mail->Body    = '<h1>Hello!</h1><p>This is a test email from PHPMailer.</p>';  

    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>
