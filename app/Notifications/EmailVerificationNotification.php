<?php

namespace App\Notifications;


use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    public string $message;
    public string $subject;
    public mixed $formEmail;
    public string $mailer;
    private Otp $otp;

    public function __construct()
    {
        $this->message = "Use the below code for verification process";
        $this->subject = "Verification Needed";
        $this->formEmail = env('MAIL_FROM_ADDRESS');
        $this->mailer = "smtp";
        $this->otp = new Otp;
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

        return (new MailMessage)
            ->mailer('smtp')
            ->subject($this->subject)
            ->greeting('Hello   ' . $notifiable->name)
            ->line($this->message)
            ->line('code: ' . $otp->token);
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
