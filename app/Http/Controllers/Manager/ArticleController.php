<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Manager\Article;
use App\Repository\Manager\articleRepo;
use App\Repository\Manager\categoryRepo;
use App\Repository\Manager\tagRepo;
use App\Service\ContentText;
use App\Service\JsonResponse;
use Illuminate\Support\Str;
use SEO;

class ArticleController extends Controller
{
    public function __construct(public articleRepo  $articleRepo,
                                public tagRepo      $tagRepo,
                                public categoryRepo $categoryRepo)
    {
    }

    public function index()
    {
        return $this->articleRepo->index();
    }

    public function store(StoreArticleRequest $request)
    {
        $wordCount = ContentText::minRead($request->get('content'));
        $article = $this->articleRepo->create($request , $wordCount);

        if($request->image) {
            $file = $request->file('image');
            $file_name = Str::random(15) . $file->getClientOriginalName();
            $path = $file->storeAs('/articles', $file_name , 'article');
            dd($article->image()->create([
                'url' => $path,
                'imageable_type' => get_class($article),
                'imageable_id' => $article->id,
                'user_id' => auth()->id(),
            ]));
        }
        if ($request->get('tags')) {
            $tags = $this->tagRepo->getFindMulti($request->get('tags'), $article);
            $tagMorph = $this->tagRepo->morphTags($tags , $article );
            dd($tagMorph);
//            $tags = $this->tagRepo->getFindMulti($request->get('tags') );
        }
        //        if($request->get('category_id')){
//            $category = $this->categoryRepo->getFindName($request->get('category_id'));
//        }
        return JsonResponse::SuccessResponse('create article success', 'success');
    }


    public function show(Article $article)
    {
        //
    }


    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }


    public function destroy(Article $article)
    {
        //
    }
}
