<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalRecordsController extends Controller
{
    public function showMedicalRecords(){
        return view('medicalrecords');
    }
}
