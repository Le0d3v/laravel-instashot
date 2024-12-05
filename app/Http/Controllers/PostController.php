<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    // Verificar su el usuario está autenticado antes de renderizar alguna página
    public function __construct() {
        $this->middleware("auth")->except(["show", "index"]);
    }

    public function index(User $user) {
        // Obtener publicaciones de los usuarios con poaginación
        $posts = Post::where("user_id", $user->id)->latest()->paginate(10);

        return view("dashboard", [
            "user" => $user, // Pasamos el usuario que obtenemos de la url 
            "posts" => $posts
        ]);
    }

    public function create() {
        return view("post.create");
    }

    public function store(Request $request) {
        // Validar el formulario
        $this->validate($request, [
            "titulo" => "required|max:100",
            "descripcion" => "required",
            "imagen" => "required"
        ]);

        // Crear el registro
         Post::create([
             "titulo" => $request->titulo,
             "descripcion" => $request->descripcion,
             "imagen" => $request->imagen,
             "user_id" => auth()->user()->id
         ]);

        // Forma de guardar registros con relaciones cuando se han incorporado relaciones con Eloquent
        // $request->user()->posts()->create([
        //     "titulo" => $request->titulo,
        //     "descripcion" => $request->descripcion,
        //     "imagen" => $request->imagen,
        //     "user_id" => auth()->user()->id
        // ]);
        
        return redirect()->route("post.index", auth()->user()->username);
    }

    public function show(User $user, Post $post) { // Colocar variables en orden a los parametros
        return view("post.show", [
            "post" => $post,
            "user" => $user
        ]);
    }

    public function destroy(Post $post) {
        // Permiso para eliminar (comprueba que el usuario sea dueño del post con un Policy)
        $this->authorize("delete", $post); 

        // Eliminar la imagen del post 
        $imagen_path = public_path("uploads/" . $post->imagen);
        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        $post->delete(); // Eliminar el post

        return redirect()->route("post.index", auth()->user()->username);
    }
}