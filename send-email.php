<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'C:/xampp/htdocs/U.P.G.R.A.D.E/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/U.P.G.R.A.D.E/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/U.P.G.R.A.D.E/PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (!$name || !$email || !$country || !$message) {
        // One or more input fields are empty
        echo "Please fill out all the fields.";
        exit();
    }

    $to = 'wmbbjtbclothing@gmail.com';
    $subject = 'New message from your website';
    $body = "Name: $name\nEmail: $email\nLocation: $country\nMessage:\n$message";

    try {
        // Configure SMTP
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'wmbbjtbclothing@gmail.com';
        $mail->Password = 'xpsohwmjrdsvseqa';
        $mail->IsHTML(true);

        // Set email parameters
        $mail->setFrom($email, $name);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->SMTPDebug = 2;
        // Send the email
        $mail->send();
        // Email sent successfully, redirect to thank-you.html
        header('Location: thank-you.html');
        exit();
    } catch (Exception $e) {
        // Email failed to send, display an error message
        echo "There was a problem sending the email. Error message: {$mail->ErrorInfo} {$mail->SMTPDebug}";
    }
}