<?php

namespace App\Models\AttributeSite;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'likeable_type', 'likeable_id' , 'is_state',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
