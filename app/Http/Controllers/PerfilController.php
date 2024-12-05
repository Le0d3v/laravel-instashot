<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PerfilController extends Controller
{
    public function __construct()
    {   
        $this->middleware("auth");
    }

    public function index(User $user) 
    {
        return view("perfil.index");
    }

    public function store(Request $request) {
        // Modificar el request par validación -> !Hacer solo en caso de última opción
        $request->request->add(["username" => Str::slug($request->username)]);
        
        // Validación
        $this->validate($request, [
            "username" => [
                "required", 
                "unique:users,username," . auth()->user()->id, 
                "min:3", 
                "max:20", 
                "not_in:twitter,editar-perfil"
            ]
        ]);

        // Guardar la imágen en caso de que halla una 
        if($request->imagen) {
            
            $imagen = $request->file("imagen");
            
            $nombreImagen = Str::uuid() . "." . $imagen->extension(); // Crear un nombre unico para las imagenes

            $path = public_path("/perfiles/" . $nombreImagen);

            $manager = new ImageManager(new Driver);

            $img = $manager->read($imagen);
            $img->resize(1000, 1000);
            $img->save($path);
        }   

        // Guardar Cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        // Redireccionar al usuario
        return redirect()->route("post.index", $usuario->username);
    }
}
