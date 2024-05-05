<?php

namespace App\Repository\Manager;

use App\Models\AttributeSite\Comment;
use App\Models\Manager\LatestNews;
use App\Service\ContentText;
use App\Service\sluggable;

class newRepo
{
    public $new;

    public function __construct()
    {
        $this->new = LatestNews::query();
    }

    public function index()
    {
        return $this->new->orderByDesc('created_at')->paginate();
    }

    public function create($data)
    {
        $wordCount = ContentText::minRead($data->get('content'));
        return LatestNews::query()->create([
            'title' => $data['title'],
            'slug' => sluggable::generate(LatestNews::class, $data['title']),
            'content' => $data['content'],
            'summary' => $data['summary'],
            'min_read' => $wordCount,
            'reporter_id' => $data['reporter_id'] ?? auth()->id(),
        ]);
    }

    public function getFindId($newId)
    {
        return $this->new->where('id', $newId)->with(['tags' => function ($q) {
            $q->select(['tags.id', 'tags.title'])->get();
        }, 'categories' => function ($q) {
            $q->select(['categories.id', 'categories.title'])->get();
        }])->first()->append(['news_image']);
    }

    public function getFindCategory($id)
    {
        return $this->new->findOrFail($id);

    }

    public function delete($id)
    {
        return $this->new->where('id', $id)->delete();
    }

    public function update($data, $new): int
    {
        $wordCount = ContentText::minRead($data->get('content'));
        return LatestNews::query()
            ->where('id', $new)
            ->update([
                'title' => $data['title'],
                'slug' => sluggable::generate(LatestNews::class, $data['title']),
                'content' => $data['content'],
                'summary' => $data['summary'],
                'min_read' => $wordCount,
                'reporter_id' => $data['reporter_id'] ?? auth()->id(),
            ]);
    }

    public function status($id, $status): int
    {
        return $this->new->where('id', $id)
            ->update(['status' => $status]);
    }

//    public function landingNewsSuccess()
//    {
//        return LatestNews::query()->where('status',
//            LatestNews::STATUS_SUCCESS)
//            ->with(['reporter' => function ($q) {
//                $q->select(['id' , 'name' , 'profile']);
//            }])
//            ->orderByDesc('created_at')->paginate(5);
//    }
    public function landingNewsSuccess()
    {
        return LatestNews::query()->where('status',
            LatestNews::STATUS_SUCCESS)
            ->with(['reporter' => function ($q) {
                $q->select(['id', 'name', 'profile']);
            }])
            ->orderByDesc('created_at')->paginate(2);
    }


    public function getBySlug(string $newId)
    {
        return LatestNews::query()->where('slug', $newId)->first();
    }

    public function searchTitle($title)
    {
        $this->new->where("title", "like", "%" . $title . "%");
        return $this;
    }

    public function searchEmail($email)
    {
        $this->new->whereHas("reporter", function ($q) use ($email) {
            return $q->where("email", "like", "%" . $email . "%");
        });
        return $this;
    }

    public function searchName($name)
    {
        $this->new->whereHas('reporter', function ($query) use ($name) {
            return $query->where("email", "LIKE", "%" . $name . "%");
        });
        return $this;
    }

    public function searchStatus($status)
    {
        if ($status)
            $this->new->where("status", $status);
        return $this;
    }

    public function paginateParents($status = null)
    {
        return $this->new->paginate();
    }

    public function frontSingleNews($slug)
    {
        $newsRepo = $this->getBySlug($slug);
        $newsRepo->load([
            'reporter' => function ($query) {
                return $query->select(['users.id', 'users.name', 'users.profile', 'users.email']);
            }, 'tags' => function ($query) {
                return $query->select(['tags.id', 'tags.title']);
            }, 'categories' => function ($query) {
                return $query->select(['categories.id', 'categories.title']);
            }, 'comments' => function ($query) {
                return $query
                    ->where('status', Comment::STATUS_APPROVED)
                    ->with(['replies']);
            }])->loadCount('comments', 'liked', 'bookmarks')->append(['article_image']);
       return  $newsRepo->makeHidden(['image', 'summary', 'status', 'reporter_id', 'updated_at']);
    }

    public function landing()
    {
        return $this->new
        ->where('status' , LatestNews::STATUS_SUCCESS )
        ->get();
    }
}
