<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\OtpMail;

class OtpNotification extends Notification
{
    private $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function toMail($notifiable)
    {
        $otpMail = new OtpMail($this->otp);

        return $otpMail;
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
