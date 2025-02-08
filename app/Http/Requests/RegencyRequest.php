<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegencyRequest extends FormRequest
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
        return [
            'province_id' => ['required', 'numeric'],
            'name' => ['required', 'unique:regencies,name', 'min:2'],
            'total_population' => ['required', 'numeric'],
        ];
    }

    /**
     * prepare for validation
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'province_id' => strtoupper($this->province),
            'name' => strtoupper($this->regency_name),
        ]);
    }   
}
