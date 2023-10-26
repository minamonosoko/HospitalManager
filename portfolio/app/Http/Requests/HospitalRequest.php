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
        \Log::info("HospitalRequest:action" . $this->input('action'));

        $action = $this->input('action');

        switch ($action) 
        {
            case 'update':
                return $this->updateRules();
            case 'delete':
                return $this->deleteRules();
            case 'delete-medicine':
                return $this->deleteMedicineRules();
            case 'create':
                return $this->createRules();
            default:
                return [];
        }
    }

    public function attributes()
    {
        $attributes = [];

        $attributes += [
            'hospital_name' => '病院名',
            'department_id' => '診療科',
            'medicine-delete' => '薬',
        ];

        return $attributes;
    }

    public function updateRules()
    {
        return ([
            'attend_previous' => 'required',
            'attend_next' => 'required|next_appointment_date:attend_previous',
        ]);
    }

    public function deleteRules()
    {
        return ([
            'hospital_id' => 'required',
        ]);
    }

    public function deleteMedicineRules()
    {
        return ([
            'medicine-delete' => 'required',
        ]);
    }

    public function createRules()
    {
        return ([
            'hospital_name' => 'required',
            'department_id' => 'required|not_in:0',
        ]);
    }
}
