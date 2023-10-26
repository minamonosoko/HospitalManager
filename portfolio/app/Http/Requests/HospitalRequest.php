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
        // 初期化：バリデーションルール
        $rules =[];

        if($this->input('action') === 'update')
        {
            $rules['attend_previous'] = 'required';
            $rules['attend_next'] = 'required|next_appointment_date:attend_previous';
            \Log::info("HospitalRequest:update");
        }
        else
        {
            $rules['hospital_name'] = 'required';
            $rules['department_id'] = 'required|not_in:0';
        }

        \Log::info($rules);
        return $rules;
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
