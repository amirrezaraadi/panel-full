<?php

namespace App\Repository\Manager;

use App\Models\Manager\Article;
use App\Service\ContentText;
use App\Service\sluggable;

class articleRepo
{
    public $article;

    public function __construct()
    {
        $this->article = Article::query();
    }

    public function index()
    {
        return $this->article->orderByDesc('created_at')->paginate();
    }

    public function create($data)
    {
        $wordCount = ContentText::minRead($data->get('content'));
        return Article::query()->create([
            'title' => $data['title'],
            'slug' => sluggable::generate(Article::class, $data['title']),
            'content' => $data['content'],
            'summary' => $data['summary'],
            'min_read' => $wordCount,
            'author_id' => $data['author_id'] ?? auth()->id(),
        ]);
    }

    public function getFindId($articleId)
    {
        return $this->article->where('id', $articleId)->with(['tags' => function ($q) {
            $q->select(['tags.id', 'tags.title'])->get();
        }, 'categories' => function ($q) {
            $q->select(['categories.id', 'categories.title'])->get();
        }])->first()->append(['article_image']);
    }

    public function getFindCategory($id)
    {
        return $this->article->findOrFail($id);

    }

    public function delete($id)
    {
        return $this->article->where('id', $id)->delete();
    }

    public function update($data, $article): int
    {
        $wordCount = ContentText::minRead($data->get('content'));
        return Article::query()
            ->where('id', $article)
            ->update([
                'title' => $data['title'],
                'slug' => sluggable::generate(Article::class, $data['title']),
                'content' => $data['content'],
                'summary' => $data['summary'],
                'min_read' => $wordCount,
                'author_id' => $data['author_id'] ?? auth()->id(),
            ]);
    }

    public function status($id, $status): int
    {
        return $this->article->where('id', $id)
            ->update(['status' => $status]);
    }

//    public function landingArticleSuccess()
//    {
//        return Article::query()->where('status',
//            Article::STATUS_SUCCESS)
//            ->with(['author' => function ($q) {
//                $q->select(['id' , 'name' , 'profile']);
//            }])
//            ->orderByDesc('created_at')->paginate(5);
//    }
    public function landingArticleSuccess()
    {
        return Article::query()->where('status',
            Article::STATUS_SUCCESS)
            ->with(['author' => function ($q) {
                $q->select(['id', 'name', 'profile']);
            }])
            ->orderByDesc('created_at')->paginate(1);
    }


    public function getBySlug(string $articleId)
    {
        return Article::query()->where('slug', $articleId)->first();
    }

    public function searchTitle($title)
    {
        $this->article->where("title", "like", "%" . $title . "%");
        return $this;
    }

    public function searchEmail($email)
    {
        $this->article->whereHas("author", function ($q) use ($email) {
            return $q->where("email", "like", "%" . $email . "%");
        });
        return $this;
    }

    public function searchName($name)
    {
        $this->article->whereHas('author', function ($query) use ($name) {
            return $query->where("email", "LIKE", "%" . $name . "%");
        });
        return $this;
    }

    public function searchStatus($status)
    {
        if ($status)
            $this->article->where("status", $status);
        return $this;
    }

    public function paginateParents($status = null)
    {
        return $this->article->paginate();
    }
}
