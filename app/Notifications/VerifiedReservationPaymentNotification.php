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
class VerifiedReservationPaymentNotification extends Notification
{
    use Queueable;
    protected $reservation;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['database',FcmChannel::class];
    }
    public function toDatabase(): array
    {
        return [
            'title'=>'Verified Reservation',
            'body'=>'Your Reservation Is Verified successfully',
            'url'=>'reservation',
            'icon'=>asset('assets/img/logo.png'),
            'image'=>asset($this->reservation->resource->imageUrl() ?? 'assets/img/avatar.jpeg'),
            'id' => $this->reservation->id,
            'name' => $this->reservation->name,
            'added_by' => $this->reservation->admin->name,
            'user_name' => $this->reservation->user->name,
            'cost' => $this->reservation->cost,
            'start_date' => $this->reservation->created_at->__toString(),
        ];
    }

    /**
     * @throws CouldNotSendNotification
     */
    public function toFcm($notifiable): FcmMessage
    {

        return FcmMessage::create()
            ->setData([
                'id' => (string) $this->reservation->id,
                'name' => $this->reservation->name,
                'added_by' => $this->reservation->admin->name,
                'user_name' => $this->reservation->user->name,
                'cost' => (string) $this->reservation->cost,
                'start_date' => $this->reservation->start_date,
                'end_date' => $this->reservation->end_date,
            ])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle('Verified Reservation')
                ->setBody('Your Reservation Is Verified successfully')
                ->setImage(asset('assets/img/logo.png')))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()
                        ->setColor('#0A0A0A')
                        ->setImage(asset($this->reservation->resource->imageUrl() ?? 'assets/img/avatar.jpeg'))
                        ->setIcon(asset('assets/img/logo.png')))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    }
}
