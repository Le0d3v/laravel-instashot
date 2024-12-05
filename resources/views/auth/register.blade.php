@extends('layouts.app')
@section('titulo')
    Registrate en DevStagram
@endsection
@section('contenido')
  <div class="md:flex justify-center md:gap-5 md:items-center">
    <div class="md:w-6/12 p-5">
      <img src="{{asset("img/registrar.jpg")}}" alt="imagen_login">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-md">
      <form action="{{route("register")}}" method="POST">
        @csrf
        <div class="mb-2">
          <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
            Nombre
          </label>
          <input 
            type="text"
            id="name"
            name="name"
            placeholder="Tu Nombre"
            class="border p-3 w-full rounded @error("name")
              border-red-500
            @enderror"
            value="{{old("name")}}"
          >
          @error('name')
              <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-2">
          <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
            Username
          </label>
          <input 
            type="text"
            id="username"
            name="username"
            placeholder="Tu Nombre de Uusario"
            class="border p-3 w-full rounde @error("username")      
            border-red-500  
          @enderror"
            value="{{old("username")}}"
          >
          @error('username')
              <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-2">
          <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
            Email
          </label>
          <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu email"
            class="border p-3 w-full rounded @error("email")      
              border-red-500  
            @enderror"
            value="{{old("email")}}"
          >
          @error('email')
              <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-2">
          <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
            Password
          </label>
          <input 
            type="password"
            id="password"
            name="password"
            placeholder="Password de Registro"
            class="border p-3 w-full rounded @error("password")      
              border-red-500  
            @enderror"
          >
          @error('password')
              <p class="bg-red-500 text-white mt-2 mb-5 rounded-lg text-sm p-2 text-center font-bold">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-2">
          <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
            Repetir Password
          </label>
          <input 
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Repite tu Password"
            class="border p-3 w-full rounded"
          >
        </div>
        <input 
          type="submit"
          value="Crear Cuenta"
          class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 rounded-md text-white mt-3"
        >
      </form>
    </div>
  </div>
@endsection