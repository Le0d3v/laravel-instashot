<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public function store(Request $request) {
        // Leer la imágen desde el request
        $imagen = $request->file("file");

        $nombreImagen = Str::uuid() . "." . $imagen->extension(); // Crear un nombre unico para las imagenes

        $path = public_path("/uploads/" . $nombreImagen);

        $manager = new ImageManager(new Driver);

        $img = $manager->read($imagen);

        $img->resize(1000, 1000);

        $img->save($path);

        //Contruir una respuesta pra dropzone
        return response()->json(["imagen" => $nombreImagen]);
    }
}
