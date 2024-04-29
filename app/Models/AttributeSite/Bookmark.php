<?php

namespace App\Models\AttributeSite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookmark extends Model
{
    use HasFactory
//       , SoftDeletes
        ;

    protected $fillable = [
        'user_id', 'bookmarkable_type', 'bookmarkable_id' , 'is_state',
    ];
}
