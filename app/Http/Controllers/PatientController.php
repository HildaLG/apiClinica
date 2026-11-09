<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\PatientResource;
use App\Http\Responses\ApiResponse;
use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    const RELACIONES = ['doctor', 'prescriptions.medication', 'appointments'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $patients = new PatientCollection(
                Patient::with('doctor')->orderBy('name', 'asc')->paginate(15)
            );
            return ApiResponse::success('Listado de pacientes', 200, $patients);
        } catch (Exception $e) {
            Log::error('Error al listar pacientes', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener el listado de pacientes', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request)
    {
        try {
            $datos = $request->validated();

            $patient = DB::transaction(function () use ($datos) {
                $patient = Patient::create(collect($datos)->except('medications')->all());

                foreach ($datos['medications'] ?? [] as $med) {
                    $patient->medications()->attach($med['medication_id'], [
                        'dosage' => $med['dosage'],
                        'frequency' => $med['frequency'],
                        'start_date' => $med['start_date'],
                        'end_date' => $med['end_date'] ?? null,
                    ]);
                }

                return $patient;
            });

            return ApiResponse::success('Paciente creado correctamente', 201, new PatientResource($patient->load(self::RELACIONES)));
        } catch (Exception $e) {
            Log::error('Error al crear paciente', ['exception' => $e]);
            return ApiResponse::error('No se pudo crear el paciente', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        try {
            return ApiResponse::success('Información del paciente', 200, new PatientResource($patient->load(self::RELACIONES)));
        } catch (Exception $e) {
            Log::error('Error al consultar paciente', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener el paciente', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        try {
            $patient->update($request->validated());
            return ApiResponse::success('Paciente actualizado correctamente', 200, new PatientResource($patient->refresh()->load(self::RELACIONES)));
        } catch (Exception $e) {
            Log::error('Error al actualizar paciente', ['exception' => $e]);
            return ApiResponse::error('No se pudo actualizar el paciente', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        try {
            if ($patient->appointments()->exists()) {
                return ApiResponse::error('No se puede eliminar un paciente con citas registradas', 409);
            }
            $patient->delete();
            return ApiResponse::success('Paciente eliminado correctamente', 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar paciente', ['exception' => $e]);
            return ApiResponse::error('No se pudo eliminar el paciente', 500);
        }
    }
}
