<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginNotification extends Notification
{
    use Queueable;

    public string $message;
    public string $subject;
    public string $formEmail;
    public string $mailer;

    public function __construct()
    {
        $this->message = "You just Logged in";
        $this->subject = "New Logging in";
        $this->formEmail = env('MAIL_FROM_ADDRESS');
        $this->mailer = "smtp";
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->mailer('smtp')
            ->subject($this->subject)
            ->greeting('Hello   ' . $notifiable->name)
            ->line($this->message);
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
