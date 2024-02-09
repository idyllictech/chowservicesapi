<?php

// app/Services/EmailService.php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class EmailService
{
    private $mailer;

    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
        $this->configureMailer();
    }

    private function configureMailer()
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = config('mail.mail_host');
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = config('mail.mail_username');
        $this->mailer->Password = config('mail.mail_password');
        $this->mailer->SMTPSecure = config('mail.mail_encryption');
        $this->mailer->Port = config('mail.mail_port');
    }

    public function send($email, $subject, $body)
    {
        try {
            $this->mailer->setFrom(config('mail.mail_from_address'), config('mail.mail_from_name'));
            $this->mailer->addAddress($email);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            return $this->mailer->send();
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Email sending error: ' . $e->getMessage());
            return false;
        }
    }
}

