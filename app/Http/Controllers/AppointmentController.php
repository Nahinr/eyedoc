<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAppointments()
    {
        return view('Appointments.appointmentsIndex');
    }

    public function calendarEvents(Request $request)
    {
     $eventList = Appointment::get(['id', 'title', 'start', 'end']);
     return response()->json(["My events"=>$eventList]);
    }

    public function filter(Request $request)
    {
        return Appointment::whereBetween('start',[$request->start, $request->end])
        ->with('patient:id,nombre_completo,identidad')
        ->get();    
        // if (auth()->check()){
           
        // }
        // else {
        //     return Appointment::whereBetween('start',[$request->start, $request->end])
        //     ->where('patient_id', auth()->user()->id)
        //     ->get();
        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $patientid = $request->patient_id;

        $appointment = new Appointment();
        $appointment->title = $request->input('title');
        $appointment->description = $request->input('description');
        $appointment->start = $request->input('start');
        $appointment->end = $request->input('end');
        $appointment->patient_id = $patientid;

        $appointment->save();

        return redirect('/appointments')->with('success', 'Cita creada con exito!');
    }

    /**
     * Display the specified resource.
     */
    public function update (Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
    
        $appointment->title = $request->title;
        $appointment->description = $request->description;
        $appointment->start = $request->start;
        $appointment->end = $request->end;
    
        $appointment->save();
    
        return redirect('/appointments')->with('success', 'Cita actualizada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
    
        $appointment->delete();
    
        return redirect('/appointments')->with('success', 'Cita eliminada con éxito!');
    }
}
