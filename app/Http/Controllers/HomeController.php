<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function __invoke()
    {
        // Obtener a quienes seguimos
        $ids = auth()->user()->followins->pluck("id")->toArray();

        // Obtener los posts de los usuarios que seguimos
        $posts = Post::whereIn("user_id", $ids)->latest()->paginate(20);

        return view("home", [
            "posts" => $posts
        ]);
    }
}