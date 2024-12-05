@extends('layouts.app')
@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('titulo')
    Crea una nueva Publicación
@endsection
@section('contenido')
    <div class="md:flex md:items-center p-3"> 
      <div class="md:w-1/2 px-10">
        <form action="{{route("imagenes.store")}}" method="POST" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center" enctype="multipart/form-data">
          @csrf
        </form>
      </div>
      <div class="md:w-1/2 px-10 bg-white p-6 rounded-lg shadow-md mt-10 md:mt-0">
        <form action="{{route("post.store")}}" method="POST" novalidate>
          @csrf
          <div class="mb-2">
            <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
              Titulo
            </label>
            <input 
              type="email"
              id="titulo"
              name="titulo"
              placeholder="Titulo de la Publicación"
              class="border p-3 w-full rounded @error("titulo")      
                border-red-500  
              @enderror"
              value="{{old("titulo")}}"
            >
            @error('titulo')
                <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
            @enderror
          </div>
          <div class="mb-2">
            <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
              Descripción
            </label>
            <textarea 
              id="descripcion"
              name="descripcion"
              placeholder="Descripción de la Publicación"
              class="border p-3 w-full rounded @error("descricion")      
                border-red-500  
              @enderror"
              rows="5"
            >
              {{old("descripcion")}}
            </textarea>
            @error('descripcion')
                <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
            @enderror
          </div>
          <div class="md-5">
            <input 
              type="hidden"
              name="imagen"
              value=""
              id="imagenPost"
            >
            @error('imagen')
              <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
            @enderror
          </div>
          <input 
            type="submit"
            value="Publicar"
            class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 rounded-md text-white mt-3"
          />
        </form>
      </div>
    </div>
@endsection