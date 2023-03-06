<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLandPropertyInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cadastre_number' => [
                'required',
                'unique:land_property_infos,cadastre_number',
                'size:11',
                'regex:/^[0-9]{11}$/',
            ],
            'land_usage' => [
                'required',
                'in:Lauksaimniecības zeme,Meža zeme,Zeme zem ūdeņiem,Apbūves platība,Cits,Nav lietojuma',
            ],
            'total_area' => [
                'required',
                'numeric',
                'min:0.01',
            ],

        ];
    }
}
