<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicationRequest;
use App\Http\Resources\MedicationCollection;
use App\Http\Resources\MedicationResource;
use App\Http\Responses\ApiResponse;
use App\Models\Medication;
use Exception;
use Illuminate\Support\Facades\Log;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $medications = new MedicationCollection(Medication::orderBy('name', 'asc')->paginate(15));
            return ApiResponse::success('Listado de medicamentos', 200, $medications);
        } catch (Exception $e) {
            Log::error('Error al listar medicamentos', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener el listado de medicamentos', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicationRequest $request)
    {
        try {
            $medication = Medication::create($request->validated())->refresh();
            return ApiResponse::success('Medicamento creado correctamente', 201, new MedicationResource($medication));
        } catch (Exception $e) {
            Log::error('Error al crear medicamento', ['exception' => $e]);
            return ApiResponse::error('No se pudo crear el medicamento', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medication $medication)
    {
        try {
            return ApiResponse::success('Información del medicamento', 200, new MedicationResource($medication));
        } catch (Exception $e) {
            Log::error('Error al consultar medicamento', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener el medicamento', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicationRequest $request, Medication $medication)
    {
        try {
            $medication->update($request->validated());
            return ApiResponse::success('Medicamento actualizado correctamente', 200, new MedicationResource($medication->refresh()));
        } catch (Exception $e) {
            Log::error('Error al actualizar medicamento', ['exception' => $e]);
            return ApiResponse::error('No se pudo actualizar el medicamento', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medication $medication)
    {
        try {
            if ($medication->patients()->exists()) {
                return ApiResponse::error('No se puede eliminar un medicamento recetado a pacientes', 409);
            }
            $medication->delete();
            return ApiResponse::success('Medicamento eliminado correctamente', 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar medicamento', ['exception' => $e]);
            return ApiResponse::error('No se pudo eliminar el medicamento', 500);
        }
    }
}
