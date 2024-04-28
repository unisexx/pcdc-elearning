<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class StPrefixRequest extends FormRequest
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
            'name_th' => 'ชื่อไทย',
            'abbr_th' => 'ชื่อย่อไทย',
            'name_en' => 'ชื่ออังกฤษ',
            'abbr_en' => 'ชื่อย่ออังกฤษ',
        ];
    }

    public function rules()
    {
        $rules = [
            'name_th' => 'required',
            'abbr_th' => 'required',
            'name_en' => 'required',
            'abbr_en' => 'required',
        ];

        return $rules;
    }
}
