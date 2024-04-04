<?php

namespace App\Service ;
class Token
{
    public static function generate($user)
    {
        return $user->createToken(
            $user->name , ['*'], now()->addWeek()
        )->plainTextToken;
    }
}
