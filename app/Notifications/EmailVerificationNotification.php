<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Waiyanhein\LumenSignedUrl\URLSigner;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerificationNotification extends Notification implements ShouldQueue
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject(trans('mail.verify_subject'))
            ->greeting(trans('mail.greetings'))
            ->line(trans('mail.verify_line'))
            ->action(trans('mail.verify_action'), $verificationUrl)
            ->line(trans('mail.verify_expiration', ['count' => $this->setting->mail_expiration]));
    }

    protected function verificationUrl($notifiable)
    {
        return URLSigner::sign(
            $this->setting->frontend_domain.
            '/verify/'.$notifiable->email.'/'.sha1($notifiable->email),
            Carbon::now()->addMinutes($this->setting->mail_expiration)->format('Y-m-d H:i:s')
        );
    }

    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return trans('mail.user_registered', ['email' => $notifiable->email]);
    }
}
