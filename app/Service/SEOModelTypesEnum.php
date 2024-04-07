<?php

namespace App\Service;

enum SEOModelTypesEnum
{
    const PAGE = 'pages';
    const PRODUCT = 'product/';
    const ARCHIVE = ['products'];
    const HOME = '/';

    const TYPES = [
        'PAGE' => self::PAGE,
        'PRODUCT' => self::PRODUCT,
        'ARCHIVE' => self::ARCHIVE,
        'HOME' => self::HOME,
    ];
}
