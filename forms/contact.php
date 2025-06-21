<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = getenv("EMAIL_USER");
    $mail->Password = getenv("EMAIL_PASS");
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;


    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('m.ragav07@gmail.com'); // Where to send the mail

    // Content
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    $mail->send();
    echo "OK";
} catch (Exception $e) {
    echo "Something went wrong. Mailer Error: {$mail->ErrorInfo}";
}
?>
