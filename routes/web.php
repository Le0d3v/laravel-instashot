<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Inicio
Route::get('/', HomeController::class)->name("home");

// Autenticación
Route::get('/register', [RegisterController::class, "index"])->name("register"); // Nombrar url para escaneo automatico
Route::post('/register', [RegisterController::class, "store"])->name("register");
Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class, "store"])->name("login");
Route::post("/logout", [LogoutController::class, "store"])->name("logout");

// Rutas para el perfil
Route::get("/editar-perfil", [PerfilController::class, "index"])->name("perfil.index");
Route::post("/editar-perfil", [PerfilController::class, "store"])->name("perfil.store");
Route::get("/{user:username}", [PostController::class, "index"])->name("post.index"); // Route Model Banding

// Posts
Route::get("/posts/create", [PostController::class, "create"])->name("post.create");
Route::post("/posts", [PostController::class, "store"])->name("post.store");
Route::get("/{user:username}/posts/{post}", [PostController::class, "show"])->name("post.show");
Route::post("/{user:username}/posts/{post}", [ComentarioController::class, "store"])->name("comentarios.store");
Route::delete("/posts/{post}", [PostController::class, "destroy"])->name("post.destroy");

// Almacenamiento de imagenes
Route::post("/imgenes", [ImageController::class, "store"])->name("imagenes.store");

// Likes
Route::post("/post/{post}/likes", [LikeController::class, "store"])->name("post.likes.store");
Route::delete("/post/{post}/likes", [LikeController::class, "destroy"])->name("post.likes.destroy");

// Siguiendo usuarios
Route::post("/{user:username}/follow", [FollowerController::class, "store"])->name("users.follow");
Route::delete("/{user:username}/unfollow", [FollowerController::class, "destroy"])->name("users.unfollow");