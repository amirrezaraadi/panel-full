<?php

namespace App\Http\Controllers\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookmarkRequest;
use App\Http\Requests\UpdateBookmarkRequest;
use App\Models\AttributeSite\Bookmark;
use App\Repository\Attribute\bookmarkRepo;
use App\Repository\Manager\articleRepo;
use App\Service\JsonResponse;
use App\Service\morph;

class BookmarkController extends Controller
{
    public function __construct(public bookmarkRepo $bookmarkRepo)
    {
    }

    public function index()
    {
        //
    }

    public function store(StoreBookmarkRequest $request, articleRepo $articleRepo)
    {
        $bookmarkable = morph::morph($request);
        $bookmatk = $this->bookmarkRepo->store($bookmarkable);
        if ($bookmatk === false)
            return JsonResponse::SuccessResponse('Cancel bookmark :)', 'success');
        if ($bookmatk === true)
            return JsonResponse::SuccessResponse('Again bookmark :)', 'success');
        return JsonResponse::SuccessResponse('bookmark :)', 'success');
    }


    public function show(Bookmark $bookmark)
    {
        //
    }


    public function update(UpdateBookmarkRequest $request, Bookmark $bookmark)
    {
        //
    }


    public function destroy(Bookmark $bookmark)
    {
        //
    }
}
