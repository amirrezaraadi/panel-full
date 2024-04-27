<?php

namespace App\Service;

class ContentText
{
    public static function minRead($content)
    {
        $wordCount = mb_strlen(strip_tags(preg_replace('/\s+/', '', $content)));

        return  ceil($wordCount / 250);
    }
}
