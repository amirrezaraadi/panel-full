<?php

namespace App\Service;

use Illuminate\Support\Str;

class ImageService
{
    public static function generate($file)
    {
        $file_name = Str::random(15) . '-' .$file->getClientOriginalName();
         $file->storeAs('/articles', $file_name, 'article');
        return $file_name ;
    }
}
