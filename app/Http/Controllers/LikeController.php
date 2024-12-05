<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post) {
        // Insersión de datos utilizando eloquent
        $post->likes()->create([
            "user_id" => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post) {
        // Eliminar el like asociado al usuario utilizando request y relaciones de eloquent
        
    }
}
