<?php

namespace App\Service;

use App\Http\Requests\StoreBookmarkRequest;
use App\Repository\Manager\articleRepo;

class morph
{
    public function __construct(public articleRepo $articleRepo){}

    public static function morph($request )
    {
        dd($request);
        $type = $request->input('type');
        $id = $request->input('id');

        switch ($type) {
            case 'article':
                $morphed  = $articleRepo->getFindCategory($id);
                break;
//            case 'product':
//                $morphed = $productRepo->getFindCategory($id);
//                break;
            default:
                return JsonResponse::NotFoundResponse('not model', 'error');
        }

        return $morphed ;
    }
}
