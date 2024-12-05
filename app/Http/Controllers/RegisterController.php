<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        // dd($request); -> Debuguear los datos recibidos por $_POST[]
        // dd($request->get("username")); -> Debuguear un dato específico recibidos por $_POST[]

        // Modificar el request par validación -> !Hacer solo en caso de última opción
        $request->request->add(["username" => Str::slug($request->username)]);

        // Validacion: Pasar el elemento que se va a validar y las reglas de validación en un arreglo
        $this->validate($request, [
            "name" => [
                "required", // -> Campo Obligatorio
                "max:50" // -> Maximo 50 caracteres en el campo
            ],

            "username" => [
                "required",
                "unique:users", // -> El valor del campo debe de ser unico
                "min:3",
                "max:20"
            ],
            
            "email" => [
                "required",
                "unique:users",
                "email",
                "max:60"
            ],

            "password" => [
                "required",
                "min:8",
                "confirmed"
            ]
        ]);

        /** Inserar el registro en la BD cuando se pasa la validación
         *  El registro toma los campos recibidos del formulario (Se obtienen del objeto $request)
         */
        User::create([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password, // Hasheo de password -> Hash::make($request->password)
        ]);

        // Autenticar al Usuario
        auth()->attempt([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
        ]);

        /** Otra forma de Autenticar
         *      auth()->attempt($request->only("emamil", "password"))
         */

        // Redireccionar al  Usuario trás la insersión
        return redirect()->route("post.index", ["user" => auth()->user()]);
    }
}
