<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorCollection;
use App\Http\Resources\DoctorResource;
use App\Http\Responses\ApiResponse;
use App\Models\Doctor;
use Exception;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //GET
    public function index()
    {
        try {
            $doctors = new DoctorCollection(Doctor::orderBy('name', 'asc')->paginate(15));
            return ApiResponse::success('Listado de doctores', 200, $doctors);
        } catch (Exception $e) {
            Log::error('Error al listar doctores', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener el listado de doctores', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //POST
    public function store(DoctorRequest $request)
    {
        try {
            $doctor = Doctor::create($request->validated())->refresh();
            return ApiResponse::success('Doctor creado correctamente', 201, new DoctorResource($doctor));
        } catch (Exception $e) {
            Log::error('Error al crear doctor', ['exception' => $e]);
            return ApiResponse::error('No se pudo crear el doctor', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    //GET INDV
    public function show(Doctor $doctor)
    {
        try {
            return ApiResponse::success('Información del doctor', 200, new DoctorResource($doctor->load('patients')));
        } catch (Exception $e) {
            Log::error('Error al consultar doctor', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener el doctor', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //PUT
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        try {
            $doctor->update($request->validated());
            return ApiResponse::success('Doctor actualizado correctamente', 200, new DoctorResource($doctor->refresh()));
        } catch (Exception $e) {
            Log::error('Error al actualizar doctor', ['exception' => $e]);
            return ApiResponse::error('No se pudo actualizar el doctor', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //DELETE
    public function destroy(Doctor $doctor)
    {
        try {
            if ($doctor->patients()->exists()) {
                return ApiResponse::error('No se puede eliminar un doctor con pacientes asignados', 409);
            }
            $doctor->delete();
            return ApiResponse::success('Doctor eliminado correctamente', 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar doctor', ['exception' => $e]);
            return ApiResponse::error('No se pudo eliminar el doctor', 500);
        }
    }
}
