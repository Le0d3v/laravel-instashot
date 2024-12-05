<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user, Request $request) {
        // Usa attach() para inserciones con datos relacionados utilizando tablas pivote con la misma tabla
        $user->followers()->attach(auth()->user()->id);
        return back();
    }
    
    public function destroy(User $user) {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
