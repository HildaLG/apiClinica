<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\AppointmentResource;
use App\Http\Responses\ApiResponse;
use App\Models\Appointment;
use Exception;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $appointments = new AppointmentCollection(
                Appointment::with('patient')->orderBy('appointment_date', 'desc')->paginate(15)
            );
            return ApiResponse::success('Listado de citas', 200, $appointments);
        } catch (Exception $e) {
            Log::error('Error al listar citas', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener el listado de citas', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        try {
            $appointment = Appointment::create($request->validated())->refresh();
            return ApiResponse::success('Cita creada correctamente', 201, new AppointmentResource($appointment->load('patient')));
        } catch (Exception $e) {
            Log::error('Error al crear cita', ['exception' => $e]);
            return ApiResponse::error('No se pudo crear la cita', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        try {
            return ApiResponse::success('Información de la cita', 200, new AppointmentResource($appointment->load('patient')));
        } catch (Exception $e) {
            Log::error('Error al consultar cita', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener la cita', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        try {
            $appointment->update($request->validated());
            return ApiResponse::success('Cita actualizada correctamente', 200, new AppointmentResource($appointment->refresh()->load('patient')));
        } catch (Exception $e) {
            Log::error('Error al actualizar cita', ['exception' => $e]);
            return ApiResponse::error('No se pudo actualizar la cita', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();
            return ApiResponse::success('Cita eliminada correctamente', 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar cita', ['exception' => $e]);
            return ApiResponse::error('No se pudo eliminar la cita', 500);
        }
    }
}
