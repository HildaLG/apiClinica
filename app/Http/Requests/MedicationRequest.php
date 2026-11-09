<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicationRequest extends FormRequest
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
            'name' => $regla.'|min:3|max:100',
            'description' => 'nullable|string',
            'presentation' => $regla.'|max:50',
            'price' => $regla.'|numeric|min:0|max:999999.99'
        ];
    }
}
