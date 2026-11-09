<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
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

    return [
        'name' => [...$regla, 'min:3', 'max:100'],
        'email' => [...$regla, 'email', 'max:150', Rule::unique('doctors', 'email')->ignore($this->route('doctor'))],
        'phone' => [...$regla, 'max:20'],
        'specialty' => [...$regla, 'min:3', 'max:100'],
        'license_number' => [...$regla, 'max:50', Rule::unique('doctors', 'license_number')->ignore($this->route('doctor'))],
    ];
}
}
