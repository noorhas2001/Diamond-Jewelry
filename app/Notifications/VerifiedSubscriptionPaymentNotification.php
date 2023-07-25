<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\Exceptions\CouldNotSendNotification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;
class VerifiedSubscriptionPaymentNotification extends Notification
{
    use Queueable;
    protected $subscription;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['database',FcmChannel::class];
    }
    public function toDatabase(): array
    {
        return [
            'title'=>'Verified Subscription',
            'body'=>'Your Subscription Is Verified successfully',
            'url'=>'subscription',
            'icon'=>asset('assets/img/logo.png'),
            'image'=>asset($this->subscription->course->imageUrl() ?? 'assets/img/avatar.jpeg'),
            'id' => $this->subscription->id,
            'user' => $this->subscription->user->name,
            'course' => $this->subscription->course->name,
            'price' => $this->subscription->price,
            'start_date' => $this->subscription?->created_at->__toString(),
        ];
    }

    /**
     * @throws CouldNotSendNotification
     */
    public function toFcm($notifiable): FcmMessage
    {

        return FcmMessage::create()
            ->setData([
                'url'=>'',
                'icon'=>'',
                'id' => (string) $this->subscription->id,
                'user' => $this->subscription->user->name,
                'course' => $this->subscription->course->name,
                'price' => (string) $this->subscription->price,
                'start_date' => $this->subscription->start_date,
                'end_date' => $this->subscription->end_date,
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('Verified Subscription')
                ->setBody('Your Subscription Is Verified successfully')
                ->setImage(''))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()
                        ->setColor('#0A0A0A')
                        ->setIcon(asset('assets/img/logo.png'))
                        ->setImage(asset($this->subscription->course->imageUrl() ?? 'assets/img/avatar.jpeg')))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    }
}
