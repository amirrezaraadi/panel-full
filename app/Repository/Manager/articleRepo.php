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

    public function update($data, $article)
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

}
