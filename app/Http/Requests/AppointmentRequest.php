<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
        $regla = $this->isMethod('POST') ? 'required' : 'sometimes|required';

        return [
            'patient_id' => $regla.'|integer|exists:patients,id',
            'appointment_date' => $regla.'|date_format:Y-m-d H:i:s',
            'reason' => $regla.'|min:3|max:255',
            'status' => 'sometimes|in:pending,completed,cancelled',
            'notes' => 'nullable|string'
        ];
    }
}
