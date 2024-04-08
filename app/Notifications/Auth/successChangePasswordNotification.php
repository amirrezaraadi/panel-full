<?php

namespace App\Notifications\Auth;

use App\Mail\Auth\successChangePasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class successChangePasswordNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail' , 'database'];
    }


    public function toMail(object $notifiable): successChangePasswordMail
    {
        return (new  successChangePasswordMail($notifiable->name))->to($notifiable->email);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your password has been successfully changed'
        ];
    }
}
