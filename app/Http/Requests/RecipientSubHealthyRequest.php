<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientSubHealthyRequest extends FormRequest
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

    public function attributes() {
        return [
            'weight' => 'น้ำหนัก',
            'height' => 'ส่วนสูง',
            'breath' => 'เสียงหายใจ',
            'breathing_rate' => 'อัตราการหายใจ',
            'date' => 'วันที่ตรวจสุขภาพ',

        ];
    }

    public function rules()
    {
        return [
            'weight' => 'required',
            'height' => 'required',
            'breath' => 'required',
            'breathing_rate' => 'required',
            'date' => 'required',
        ];
    }

}

