<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $regla = $this->isMethod('POST') ? ['required'] : ['sometimes', 'required'];

        $reglas = [
    'doctor_id' => [...$regla, 'integer', 'exists:doctors,id'],
    'name' => [...$regla, 'min:3', 'max:100'],
    'email' => [...$regla, 'email', 'max:150', Rule::unique('patients', 'email')->ignore($this->route('patient'))],
    'phone' => [...$regla, 'max:20'],
    'birthdate' => [...$regla, 'date_format:Y-m-d'],
    'gender' => [...$regla, 'in:M,F,O'],
    'address' => 'nullable|string|max:255',
];

        if ($this->isMethod('POST')) {
            $reglas['medications'] = 'sometimes|array';
            $reglas['medications.*.medication_id'] = ['required', 'integer', 'distinct', 'exists:medications,id'];
            $reglas['medications.*.dosage'] = 'required|string|max:50';
            $reglas['medications.*.frequency'] = 'required|string|max:50';
            $reglas['medications.*.start_date'] = 'required|date_format:Y-m-d';
            $reglas['medications.*.end_date'] = 'nullable|date_format:Y-m-d|after_or_equal:medications.*.start_date';
        }

        return $reglas;
    }
}
