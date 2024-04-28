<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class StOrganizationRequest extends FormRequest
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
            'name' => 'ชื่อโครงสร้าง',
            'how_many_get' => 'จำนวนที่รับได้',
            'how_many_get_male' => 'จำนวนที่รับได้(ชาย)',
            'how_many_get_female' => 'จำนวนที่รับได้(หญิง)',
            'first_old' => 'อายุ',
            'last_old' => 'อายุ',
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'how_many_get' => 'required',
            'how_many_get_male' => 'required',
            'how_many_get_female' => 'required',
            'first_old' => 'required',
            'last_old' => 'required',

        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'status_id' => $this->input('status_id', '0'),
        ]);

    }
}
