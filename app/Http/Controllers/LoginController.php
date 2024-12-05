<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    public function index() {
        return view("auth.login");
    }

    public function store(Request $request) {
        // Validaciones en el formulario
        $this->validate($request, [
            "email" => [
                "required",
                "email",
            ],

            "password" => [
                "required",
            ]
        ]);

        // Comprobar si las credenciales de acceso son correctas
        if(!auth()->attempt($request->only("email", "password"), $request->remember)) {
            /**  back() sirve para volver a la url anterior y con el metdodo with podemos pasar un mensaje que podemos mostrar en la vista
             * ~ "Vuelve a la pagina anterior con este mensaje"
            */
            return back()->with("mensaje", "Credenciales de Acceso Incorrectas"); 
        } 
        return redirect()->route("post.index", auth()->user()->username); // Redirecciona al usuario en caso de haberse autenticado
    }
}