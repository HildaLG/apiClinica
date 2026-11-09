<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InsuranceRequest extends FormRequest
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
        'code' => [...$regla, 'max:50', Rule::unique('insurances', 'code')->ignore($this->route('insurance'))],
        'phone' => [...$regla, 'max:20'],
        'coverage_percentage' => ['sometimes', 'integer', 'min:0', 'max:100'],
    ];
}
}
