<?php

namespace App\Http\Controllers;

use App\Repository\Manager\articleRepo;
use App\Repository\Manager\newRepo;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function __invoke(Request $request , newRepo $newRepo , articleRepo $articleRepo)
    {
        $news = $newRepo->landing();
        $articles = $articleRepo->landing();

    }
}
