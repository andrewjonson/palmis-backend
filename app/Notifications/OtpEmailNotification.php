<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $setting;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($setting)
    {
        $this->setting = $setting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('mail.otp_subject'))
            ->greeting(trans('mail.greetings'))
            ->line(trans('mail.otp_line', ['code' => $notifiable->otp_code]))
            ->line(trans('mail.otp_expiration', ['count' => $this->setting->otp_expiration]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
