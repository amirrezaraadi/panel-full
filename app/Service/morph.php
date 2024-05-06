<?php

namespace App\Service;

use App\Http\Requests\StoreBookmarkRequest;
use App\Repository\Manager\articleRepo;

class morph
{
    public static function morph($request)
    {
        $articleRepo = new articleRepo();
        $type = $request->input('type');
        $id = $request->input('id');

        switch ($type) {
            case 'article':
                $morphed = $articleRepo->getFindCategory($id);
                break;
//            case 'product':
//                $morphed = $productRepo->getFindCategory($id);
//                break;
            default:
                return JsonResponse::NotFoundResponse('not model', 'error');
        }

        return $morphed;
    }
}
