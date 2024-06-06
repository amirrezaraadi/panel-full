<?php

namespace App\Models;

use App\Models\AttributeSite\Comment;
use App\Models\Manager\Article;
use App\Models\Manager\Product;
use App\Notifications\Auth\ForegetPasswordNotification;
use App\Notifications\Auth\successChangePasswordNotification;
use App\Traits\HasImage;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

//use Artesaos\SEOTools\Traits\SEOTools;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles,
        HasImage,
        SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'profile',
        'ip_address',
        'email_verified_at'
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailForgetPassword()
    {
        $this->notify(new ForegetPasswordNotification());
    }

    public function successChangePassword()
    {
        $this->notify(new successChangePasswordNotification());
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function guardName()
    {
        return 'api';
    }
}
