<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class NewCourseNotification extends Notification
{
    use Queueable;

    protected $course;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($course)
    {
        $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',FcmChannel::class];
    }

    public function toDatabase(): array
    {
        return [
            'title'=>'New Course',
            'body'=>'New Course Is Created',
            'url'=>'course',
            'icon'=>asset('assets/img/logo.png'),
            'image'=>asset($this->course->imageUrl() ?? 'assets/img/avatar.jpeg'),
            'id' => $this->course->id,
            'name' => $this->course->name,
            'added_by' => $this->course->admin->name,
            'hours' => $this->course->hours,
            'price' => $this->course->price,
            'start_date' => $this->course->start_date,
            'end_date' => $this->course->end_date,
        ];
    }
    public function toFcm($notifiable)
    {

        return FcmMessage::create()
            ->setData([
                'url'=>'',
                'icon'=>'',
                'id' => (string) $this->course->id,
                'name' => $this->course->name,
                'added_by' => $this->course->admin->name,
                'hours' => (string) $this->course->hours,
                'price' => (string) $this->course->price,
                'start_date' => $this->course->start_date,
                'end_date' => $this->course->end_date,
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('New Course')
                ->setBody('New Course Is Created')
                ->setImage(''))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()
                        ->setColor('#0A0A0A')
                        ->setIcon(asset('assets/img/logo.png'))
                        ->setImage(asset($this->course->imageUrl() ?? 'assets/img/avatar.jpeg')))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));


    }
}
