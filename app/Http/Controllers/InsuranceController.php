<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsuranceRequest;
use App\Http\Resources\InsuranceCollection;
use App\Http\Resources\InsuranceResource;
use App\Http\Responses\ApiResponse;
use App\Models\Insurance;
use Exception;
use Illuminate\Support\Facades\Log;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $insurances = new InsuranceCollection(Insurance::orderBy('name', 'asc')->paginate(15));
            return ApiResponse::success('Listado de aseguradoras', 200, $insurances);
        } catch (Exception $e) {
            Log::error('Error al listar aseguradoras', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener el listado de aseguradoras', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsuranceRequest $request)
    {
        try {
            $insurance = Insurance::create($request->validated())->refresh();
            return ApiResponse::success('Aseguradora creada correctamente', 201, new InsuranceResource($insurance));
        } catch (Exception $e) {
            Log::error('Error al crear aseguradora', ['exception' => $e]);
            return ApiResponse::error('No se pudo crear la aseguradora', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Insurance $insurance)
    {
        try {
            return ApiResponse::success('Información de la aseguradora', 200, new InsuranceResource($insurance));
        } catch (Exception $e) {
            Log::error('Error al consultar aseguradora', ['exception' => $e]);
            return ApiResponse::error('No se pudo obtener la aseguradora', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsuranceRequest $request, Insurance $insurance)
    {
        try {
            $insurance->update($request->validated());
            return ApiResponse::success('Aseguradora actualizada correctamente', 200, new InsuranceResource($insurance->refresh()));
        } catch (Exception $e) {
            Log::error('Error al actualizar aseguradora', ['exception' => $e]);
            return ApiResponse::error('No se pudo actualizar la aseguradora', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurance $insurance)
    {
        try {
            $insurance->delete();
            return ApiResponse::success('Aseguradora eliminada correctamente', 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar aseguradora', ['exception' => $e]);
            return ApiResponse::error('No se pudo eliminar la aseguradora', 500);
        }
    }
}
