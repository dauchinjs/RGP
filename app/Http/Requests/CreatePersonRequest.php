<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreatePersonRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        $type = $request->get('type');

        if ($type === 'juridiska') {
            return [
                'personal_code' => [
                    'required',
                    'string',
                    'unique:people,personal_code',
                    'regex:/^[0-9]{11}$/',
                ],
                'type' => [
                    'required',
                    'in:juridiska,fiziska',
                ],
                'title' => [
                    'required',
                    'string',
                ],
            ];
        }

        return [
            'name' => [
                'required',
                'string',
            ],
            'surname' => [
                'required',
                'string',
            ],
            'personal_code' => [
                'required',
                'string',
                'unique:people,personal_code',
                'regex:/^\d{6}-\d{5}$/',
            ],
            'type' => [
                'required',
                'in:juridiska,fiziska',
            ],
        ];
    }
}
