@extends("layouts.app")
@section("titulo")
  Editar Perfil: {{auth()->user()->username}}
@endsection
@section("contenido")
  <div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
      <form method="POST" action="{{route("perfil.store")}}" class="mt-10 md:mt-0" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
          <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
            Username
          </label>
          <input 
          
            type="text"
            id="username"
            name="username"
            placeholder="Tu Nombre de Uusario"
            class="border p-3 w-full rounded @error("username")
              border-red-500
            @enderror"
            value="{{auth()->user()->username ?? old("username")}}"
          >
          @error('username')
              <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-2">
          <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
            Imágen Perfil
          </label>
          <input 
            id="imagen"
            name="imagen"
            type="file"
            accept=".jpg, .jpeg, .png"
            class="border p-3 w-full rounded"
          >
          @error('name')
              <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
          @enderror
        </div>
        <input 
          type="submit"
          value="Guardar Cambios"
          class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 rounded-md text-white mt-3"
        >
      </form>
    </div>
  </div>
@endsection