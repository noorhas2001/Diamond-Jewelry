<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Otp $otp;

    public function __construct(private string $mailer = 'smtp')
    {
        $this->otp = new Otp();
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $lastOtpTime = Cache::get('last_otp_' . $notifiable->email);
        $currentTime = time();


        $timeDiff = $lastOtpTime ? $currentTime - $lastOtpTime : 60;

        if ($timeDiff < 60) {
            $waitTime = 60 - $timeDiff;
            throw new \Exception('Please wait ' . $waitTime . ' seconds before requesting another OTP');
        }

        $otp = $this->otp->generate($notifiable->email, 6, 60);

        Cache::put('last_otp_' . $notifiable->email, $currentTime, 60);

        return (new MailMessage())
            ->mailer($this->mailer)
            ->subject('Password resetting')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Use the below code for resetting your password')
            ->line('Code: ' . $otp->token);
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
