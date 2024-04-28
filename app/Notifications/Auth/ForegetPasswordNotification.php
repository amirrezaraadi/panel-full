<?php

namespace App\Notifications\Auth;

use App\Mail\Auth\ForgetPasswordMail;
use App\Service\VerifyCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ForegetPasswordNotification extends Notification
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

    public function toMail(object $notifiable): ForgetPasswordMail
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code, 120);
        return (new ForgetPasswordMail($code , $notifiable->name ))->to($notifiable->email) ;
    }

    public function toArray(object $notifiable): array
    {
        return [
            'name' => $notifiable->name ,
            'email' => $notifiable->email ,
        ];
    }
}
