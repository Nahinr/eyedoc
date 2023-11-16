<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicalRecordsController;
use Faker\Guesser\Name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);



Route::middleware('auth')->group(function () {
    // dd(auth()->check());
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    //users
    Route::get('/usuarios', [UserController::class, 'allusers'])->name('users');

    // Route::get('/Agenda', [AgendaController::class, 'showAgenda'])->name('agenda');


    //Patients
    Route::get('/Patients', [PatientController::class, 'showPatients'])->name('patients');
    
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/Patients', [PatientController::class, 'store'])->name('patients.store');


    Route::get('/medicalrecords', [MedicalRecordsController::class, 'showMedicalRecords'])->name('records');


    //Appointments
    Route::get('/appointments', [AppointmentController::class, 'showAppointments'])->name('appointments');
    Route::get('/appointments/show', [AppointmentController::class, 'calendarEvents'])->name('appointments.show'); //esta
    Route::post('/appointments/create', [AppointmentController::class, 'store'])->name('appointments.create');
    Route::patch('/appointments/{appointment}/edit', [AppointmentController::class, 'update'])->name('appointments.edit');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});
