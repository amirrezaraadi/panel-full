<?php

namespace App\Models;

use App\Http\Middleware\SeoMiddleware;
//use Artesaos\SEOTools\Traits\SEOTools;
use App\Notifications\Auth\ForegetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Artesaos\SEOTools\Facades\SEOTools;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'profile',
        'ip_address',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailForgetPassword()
    {
        return $this->notify(new ForegetPasswordNotification());
    }
    const STATUS_USER_SUCCESS = 'success';
    const STATUS_USER_PENDING = 'pending';
    const STATUS_USER_REJECT = 'reject';
    const STATUS_USER_BAN = 'ban';
    const STATUS_USER_ACTIVE = 'active';
    public static $status = [
        self::STATUS_USER_SUCCESS,
        self::STATUS_USER_PENDING,
        self::STATUS_USER_REJECT,
        self::STATUS_USER_BAN,
        self::STATUS_USER_ACTIVE,
    ];

    // Define a saved event listener
    protected static function boot()
    {
        parent::boot();
        static::saved(function ($user) {
            SEOTools::setTitle($user->name);
        });
    }

}
