@extends("layouts.app")
@section("titulo")
  {{$post->titulo}}
@endsection
@section("contenido")
  <div class="container mx-auto md:flex">
    <div class="md:w-1/2">
      <img 
        src="{{asset("uploads/" . $post->imagen)}}" 
        alt="imagen del post {{$post->titulo}}"
      >
      <div class="p-3 flex items-center gap-4">
        @auth  
          <livewire:like-post :post="$post"/>
        @endauth
      </div>
      <div>
        <p class="font-bold text-lg">
          {{$post->user->username}}
        </p>
        <p class="text-sm text-gray-500">
          {{$post->created_at->diffForHumans()}}
        </p>
        <p class="mt-5">
          {{$post->descripcion}}
        </p>
      </div>
      @auth  
        @if ($post->user_id === auth()->user()->id)  
          <form action="{{route("post.destroy", $post)}}" method="POST">
            @method("DELETE") <!-- Metodo Spoofing (Permite realizar más peticiones al servidor )-->
            @csrf
            <input 
              type="submit"
              value="Eliminar Post"
              class="bg-red-600 hover:bg-red-700 p-2 rounded text-white mt-4 cursor-pointer font-bold"
            >
          </form>
        @endif
      @endauth
    </div>
    <div class="md:w-1/2 p-5">
      <div class="shadow bg-white p-5 mb-5">
        @auth
        <p class="text-xl font-bold text-center mb-4">
          Agrega un Nuevo Comentario
        </p>
        @if (session("message"))
          <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
            <p>{{session("message")}}</p>
          </div>
        @endif
        <form 
          action="{{route("comentarios.store", [$user, $post])}}"
          method="POST"
        >
          @csrf
            <div class="mb-2">
              <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                Añade Comentario
              </label>
              <textarea 
                id="comentario"
                name="comentario"
                placeholder="Agrega un Comentario"
                class="border p-3 w-full rounded @error("descricion")      
                  border-red-500  
                @enderror"
                rows="5"
              >
              </textarea>
              @error('comentario')
                  <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
              @enderror
            </div>
            <input 
            type="submit"
            value="Comentar"
            class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 rounded-md text-white mt-3"
            />
        </form>
        @endauth
        <div class="bg-gray-100 shadow max-h-96 overflow-y-scroll mt-10">
          <h3 class="text-center mt-5 font-bold text-2xl">
            Comentarios
          </h3>
          @if ($post->comentarios->count())
            @foreach ($post->comentarios as $comentario)
              <div class="p-5 border-gray-300 border-b">
                <a href="{{route("post.index", $comentario->user)}}" class="font-bold flex gap-1 items-center">
                  <img src="{{asset("img/usuario.svg")}}" alt="imagen del usuario" width="20">
                  {{$comentario->user->username}}
                </a>
                <div class="flex justify-between">
                  <p>{{$comentario->comentario}}</p>
                  <p class="text-sm text-gray-500">
                    {{$comentario->created_at->diffForHumans()}}
                  </p>
                </div>
              </div>
            @endforeach
          @else
            <p class="p-10 text-center">
              No hay Comentarios Aún
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection