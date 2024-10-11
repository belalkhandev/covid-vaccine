<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaccineRegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'nid' => 'required|string|unique:vaccine_recipients,nid',
            'contact_no' => 'required',
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'nid.required' => 'NID is required',
            'nid.unique' => 'NID already exists',
            'contact_no.required' => 'Contact number is required',
            'vaccine_center_id.required' => 'Vaccine center is required',
        ];
    }
}
