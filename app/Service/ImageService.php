<?php

namespace App\Service;
use Illuminate\Support\Facades\File;
use App\Models\Manager\Article;
use App\Models\Media\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImageService
{


    public static function generate($file)
    {
        $file_name = Str::random(15) . '-' . $file->getClientOriginalName();
        $file->storeAs('/articles', $file_name, 'article');
        return $file_name;
    }

    public static function deleteImageArticle($file)
    {
        $deleteImage =  Image::query()->where(  'imageable_type' , $file)
                        ->where( 'imageable_id'  ,  $file->id )->first() ;
          if( ! is_null( $deleteImage  )) {
              if ( File::exists(public_path('images/articles/' .  $deleteImage->url ))) {
                  File::delete(public_path('images/articles/' . $deleteImage->url ));
              }
              $deleteImage->delete();
          }
          return true;

    }

    public static function generate_new($file)
    {
        $file_name = Str::random(15) . '-' . $file->getClientOriginalName();
        $file->storeAs('/news', $file_name, 'news');
        return $file_name;
    }

    public static function deleteImage_new($file)
    {
        $deleteImage =  Image::query()->where(  'imageable_type' , $file)
            ->where( 'imageable_id'  ,  $file->id )->first() ;
        dd($deleteImage);
        if( ! is_null( $deleteImage  )) {
            if ( File::exists(public_path('images/news/' .  $deleteImage->url ))) {
                File::delete(public_path('images/news/' . $deleteImage->url ));
            }
            $deleteImage->delete();
        }
        return true;

    }
}
