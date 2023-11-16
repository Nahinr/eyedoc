<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    
    public function showPatients(){
        
        $patients = Patient::all();

        return view('patients', compact('patients'));
    }

    public function create(){
        return view('patientCreate');
    }

    public function store(Request $request){

       

        $request->validate([
            'nombre_completo' => 'required',
            'fecha_nacimiento' => 'required',
            'edad' => 'required|integer|min:0',
            'identidad' => 'required|digits:13',            
            'telefono' => 'required',
         ]);

         $fechaNacimiento = Carbon::parse($request->fecha_nacimiento);
         $hoy = Carbon::now();
         $edadCalculada = $hoy->diffInYears($fechaNacimiento);

         if($request->edad != $edadCalculada){
            return redirect('/patients/create')->with('error', 'La edad no coincide con la fecha de nacimiento');
         }

         $patient = new Patient();
         $patient->nombre_completo = $request->input('nombre_completo');
         $patient->fecha_nacimiento = $request->input('fecha_nacimiento');
         $patient->identidad = $request->input('identidad');
         $patient->edad = $request->input('edad');
         $patient->telefono = $request->input('telefono');
         $patient->save();

         return redirect('/patients')->with('success', 'Paciente creado correctamente');
         
    }
}
