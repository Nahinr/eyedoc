<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAppointments()
    {
        return view('Appointments.appointmentsIndex');
    }

    public function store (Request $request): JsonResponse
    {
        // dd($request->all());

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'title' => 'required|string',
            'description' => 'string',
            'start' => 'required |date',
            'end' => 'required |date|after:start',
        ]);

        $start = Carbon::parse($request->input('start'));
        $end = Carbon::parse($request->input('end'));

        $apointment = Appointment::create([
            'patient_id' => $request->input('patient_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start' => $start,
            'end' => $end,
        ]);

        $apointment->load('patient');

        return response()->json($apointment,201);
    }

    public function calendarEvents(Request $request)
    {
       $events = DB::table('appointments')->select('id', 'title', 'start', 'end')->get();
       
       $formattedEvents = $events->map(function ($event) {
           return [
               'id' => $event->id,
               'title' => $event->title,
               'start' => $event->start,
               'end' => $event->end,
           ];
       });
       
       return response()->json($formattedEvents);
    }


}

    