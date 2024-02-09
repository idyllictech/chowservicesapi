<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    private $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        $url = config('app.url'); // Change this to your application URL
        $url .= "/verify-otp?otp={$this->otp}";

        return $this
            ->subject('Email Verification OTP')
            ->html("Thank you for registering with FoodHub!<br><br>Your OTP for email verification is: {$this->otp}. This OTP is valid for 15 minutes.<br><br><a href=\"{$url}\">Verify Email</a><br><br>If you did not register on FoodHub, please ignore this email.");
    }
}

