<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
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
            'hospital_name' => 'required',
            'department_id' => 'required|not_in:0',
        ];

        // $validate = [];

        // $validate += [
        //     'hospital_name' => [
        //         'require'
        //     ]
        // ];
        
        // $validate += [
        //     'department_id' => [
        //         'required',
        //         'not_in:0'
        //     ]
        // ];

        // return $validate;
    }

    public function attributes()
    {
        $attributes = [];

        $attributes += [
            'hospital_name' => '病院名',
            'department_id' => '診療科',
        ];

        return $attributes;
    }
}
