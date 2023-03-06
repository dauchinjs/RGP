<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLandPropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'cadastre_number' => [
                'required',
                'unique:land_properties,cadastre_number',
                'size:11',
                'regex:/^[0-9]{11}$/',
            ],
            'status' => [
                'required',
                'in:Ir pirkšanas līgums,Apmaksāts,Reģistrēts zemes grāmatā,Pārdots',
            ],
        ];
    }
}
