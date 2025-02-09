<?php
require 'vendor/autoload.php'; // Load PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $recipientEmail = $_POST['email'];
    $recipientName = $_POST['name'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'najahaee16@gmail.com.com';
        $mail->Password = 'tieh pqde ichc aitn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('najahnasuha1601@gmail.com', 'RideMate UiTM Jasin');
        $mail->addAddress($recipientEmail, $recipientName);

        $mail->isHTML(true);
        $mail->Subject = 'Ride Cancellation Notification';
        $mail->Body = "<p>Hello $recipientName,</p>
                       <p>Your ride has been canceled.</p>
                       <p>Thank you,<br>UiTM E-Hailing Service</p>";

        $mail->send();
        echo "Email sent successfully to $recipientEmail.";
    } catch (Exception $e) {
        echo "Failed to send email: {$mail->ErrorInfo}";
    }
}
?>
