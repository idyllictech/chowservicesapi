<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function sendTestEmail(Request $request)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = config('mail.host');  // Use your SMTP host
            $mail->SMTPAuth = true;
            $mail->Username = config('mail.username'); // SMTP username
            $mail->Password = config('mail.password'); // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = config('mail.port'); // TCP port to connect to

            // Recipients
            $mail->setFrom(config('mail.from.address'), config('mail.from.name'));
            $mail->addAddress('recipient@example.com'); // Add recipient email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Test Email';
            $mail->Body = 'This is a test email. If you receive this, email sending is working!';

            $mail->send();
            
            return response()->json(['message' => 'Test email sent successfully.']);
        } catch (Exception $e) {
            // Ensure the error message is UTF-8 encoded
            $errorInfo = mb_convert_encoding($mail->ErrorInfo, 'UTF-8', 'UTF-8');

            return response()->json(['error' => 'Error sending test email. ' . $errorInfo]);
        }
    }
}
