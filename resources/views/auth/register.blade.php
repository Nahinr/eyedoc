@extends('layouts.dashboard')

@section('content')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    @vite('resources/css/app.css')
</head>
<div class="m-5" >
	<div class="mt-10 ">

        <div class="flex justify-end">
            <button onclick="location.href='{{ route('users') }}'" class=" mb-2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium py-2 px-4 rounded">
              Regresar
            </button>
          </div>
        
		<form method="POST" action="{{ route('register') }}" class=" bg-white p-10 rounded-lg shadow-lg min-w-full">

            @csrf
			<h1 class=" text-2xl mb-6 text-gray-600 font-bold font-sans">Crear nuevo Usuario</h1>
                <div>
                    <label class="font-semibold text-sm text-gray-600 pb-1 block" for="name">Nombre</label>
                    <input class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" type="text" name="name" id="name" placeholder="Tu nombre" value="{{ old('name') }}" required @error('name') border-red-500 @enderror/>
                    @error('name')
                        <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                                            
                    @enderror
                </div>
                <div>
                    <label class="font-semibold text-sm text-gray-600 pb-1 block" for="email">Correo</label>
                    <input class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" type="text" name="email" id="email" placeholder="Tu correo" value="{{ old('email') }}" required @error('email') border-red-500 @enderror/>
                    @error('email')
                        <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                                            
                     @enderror
                </div>
                <div>
                    <label class="font-semibold text-sm text-gray-600 pb-1 block" for="phone">Telefono</label>
                    <input class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" type="phone" name="phone" id="phone" placeholder="Tu telefono" value="{{ old('phone') }}" required @error('phone') border-red-500 @enderror/>
                    @error('phone')
                        <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                                            
                     @enderror
                </div>
                <div>
                    <label class="font-semibold text-sm text-gray-600 pb-1 block" for="password">Password</label>
                    <input class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" type="password" name="password" id="password" placeholder="contraseña" required @error('password') border-red-500 @enderror/>
                    @error('password')
                        <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                                            
                     @enderror
                </div>
                <div>
                    <label class="font-semibold text-sm text-gray-600 pb-1 block" for="password_confirmation">Confirmar contraseña</label>
                    <input class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" id="password_confirmation" name="password_confirmation" type="password" placeholder="confirmar contraseña" required />
                </div>
                <div>
                    <label class="font-semibold text-sm text-gray-600 pb-1 block" for="confirm">Rol</label>
                    <select class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" type="text" name="role" id="role" value="{{ old('role') }}" required>
                        <option value="medico">Médico</option>
                        <option value="secretaria">Secretaria</option> 
                        @error('role')
                            <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                                            
                        @enderror
                    </select>
                </div>
			<button type="submit" class="transition duration-200 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200  w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block mt-10">Agregar</button>
		</form>
	</div>
</div>
@endsection