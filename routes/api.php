<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/doctor', DoctorController::class);
Route::apiResource('/patient', PatientController::class);
Route::apiResource('/medication', MedicationController::class);
Route::apiResource('/insurance', InsuranceController::class);
Route::apiResource('/appointment', AppointmentController::class);
