<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $resetUrl;

    public function __construct($email, $resetUrl)
    {
        $this->email = $email;
        $this->resetUrl = $resetUrl;
    }

    public function build()
    {
        return $this->subject('Khôi phục mật khẩu - UnitekVN')
                    ->markdown('emails.auth.reset-password')
                    ->with([
                        'email' => $this->email,
                        'resetUrl' => $this->resetUrl,
                    ]);
    }
}
