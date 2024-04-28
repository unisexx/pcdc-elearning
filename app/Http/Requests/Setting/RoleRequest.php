<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'ชื่อสิทธิ์การเข้าถึง',          
        ];
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',        
        ];

        return $rules;
    }
}

