<?php

namespace App\Livewire;

use Livewire\Component;

use function Termwind\render;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    // Verifica si el usuario ha dado like cuando se carga el componente
    public function mount($post) 
    {   
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }
    
    // Controla la funcionalidad de likes en un posts
    public function like()
    {
        // Eliminar el like si el usuario ya ha dado like
        if($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where("post_id", $this->post->id)->delete(); 
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                "user_id" => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
