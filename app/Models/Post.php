<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "titulo",
        "descripcion",
        "imagen",
        "user_id"
    ];

    // Crear método de relacion de post con un usuario (Uno a Uno)
    public function user() {
        return $this->belongsTo(User::class)->select(["name", "username"]);
    }

    // Método para relacion de muchos a muchos 
    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }

    // Establece relacion con base de datos y permite utilizar el modelo dlike con sintaxis de flecha desde este modelo 
    public function likes() {
        return $this->hasMany(Like::class);
    }

    // Revisar si u usuario ha dado me gusta a un post
    public function checkLike(User $user) {
        // Se posiciona en la tabla de likes y revisa si ya existe un registro con el id del usuario colocado
        return $this->likes->contains("user_id", $user->id);
    }
}
