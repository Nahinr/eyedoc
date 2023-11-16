<!-- resources/views/create.blade.php -->
@extends('layouts.dashboard')

@section('content')
<div class="m-5"> 
  <div class="mt-10">
    <div class="flex justify-end">
        <button onclick="location.href='{{ route('patients') }}'" class=" mb-2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium py-2 px-4 rounded">
        Regresar
        </button>
    </div>

    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <div class="flex flex-col mt-8 ml-6">
            <!-- component -->
        <div class=" p-6 bg-gray-100 flex items-center justify-center ">
            <div class="container max-w-screen-lg mx-auto">
              <div>             
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                  <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                    <div class="text-gray-600">  
                        <H2 class="text-2xl mb-6 text-gray-600 font-bold font-sans">Agregar Paciente</H2>                   
                      
                    </div>
          
                    <div class="lg:col-span-2">
                      <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                        <div class="md:col-span-5">
                          <label for="nombre_completo">Nombre Completo</label>
                          <input class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" type="text" name="nombre_completo" id="nombre_completo" placeholder="Tu nombre" value="{{ old('name') }}" required @error('nombre_completo') border-red-500 @enderror />
                          @error('nombre_completo')
                              <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                              
                          @enderror
                        </div>
          
                        <div class="md:col-span-5">
                          <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                          <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"  value="{{ old('fecha_nacimiento') }}" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"  required  @error('fecha_nacimiento') border-red-500 @enderror/>
                          @error('fecha_nacimiento')
                                <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                              
                          @enderror
                        </div>
          
                        <div class="md:col-span-5">
                          <label for="edad">Edad</label>
                          <input class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" type="text" name="edad" id="edad"  value="{{old('edad')}}" placeholder="Edad" required @error('edad') border-red-500 @enderror />
                          @error('edad')
                            <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                              
                          @enderror
                        </div>
          
                        <div class="md:col-span-5">
                          <label for="identidad">Identidad</label>
                          <input class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"  type="text" name="identidad" id="identidad" value="{{old('identidad')}}" placeholder="0101-1900-01010" required @error('identidad') border-red-500 @enderror />
                          @error('identidad')
                            <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                              
                          @enderror
                        </div>
       
                        <div class="md:col-span-5">
                          <label for="telefono">Telefono</label>
                          <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                            <input class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" type="text" name="telefono" id="telefono" value="{{old('telefono')}}" placeholder="9999-9999" required @error('telefono') border-red-500 @enderror/>
                            @error('telefono')
                                <p class="text-red-500 text-xs -mt-4 mb-3">{{ $message }}</p>                              
                          @enderror
                          </div>
                        </div>
                        <div class="md:col-span-5 mt-7 text-right">
                          <div class="inline-flex items-end">
                            <button type="submit" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-bold py-2 px-4 rounded">Agregar</button>
                          </div>
                        </div>
          
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          
              <a href="https://www.buymeacoffee.com/dgauderman" target="_blank" class="md:absolute bottom-0 right-0 p-4 float-right"></a>
            </div>
          </div>
        </div>
    </form>
  </div>
  </div>
@endsection