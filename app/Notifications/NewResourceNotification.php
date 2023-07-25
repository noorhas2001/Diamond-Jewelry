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

class NewResourceNotification extends Notification
{
    use Queueable;

    protected $resource;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
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
            'title'=>'New Resource',
            'body'=>'New Resource Is Created',
            'url'=>'resource',
            'icon'=>asset('assets/img/logo.png'),
            'image'=>asset($this->resource->imageUrl() ?? 'assets/img/avatar.jpeg'),
            'id' => (string) $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'added_by' => $this->resource->user->name,
        ];
    }
    public function toFcm($notifiable)
    {

        return FcmMessage::create()
            ->setData([
                'url'=>'',
                'icon'=>'',
                'id' => (string) $this->resource->id,
                'name' => $this->resource->name,
                'description' => $this->resource->description,
                'added_by' => $this->resource->user->name,
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('New Resource')
                ->setBody('New Resource Is Created')
                ->setImage(''))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()
                        ->setColor('#0A0A0A')
                        ->setIcon(asset('assets/img/logo.png'))
                        ->setImage(asset($this->resource->imageUrl() ?? 'assets/img/avatar.jpeg')))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));


    }
}
