<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientSubAllRequest extends FormRequest
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
            'test_fail' => 'จำนวนครั้งที่สอบตก',
            'date_disease' => 'วันที่เกิดโรค',
            'hard_disease' => 'โรคที่เคยเป็นหนัก',
            'date' => 'วันที่ตรวจสุขภาพ',
            'how_vaccine' => 'ครั้งที่ใช้วัคซีน',
            'offer_date' => 'วันที่กรอกใบมอบอำนาจ',
            'offer_old' => 'อายุ',
        ];
    }

    public function rules()
    {
        return [
            'test_fail' => 'required',
            'date_disease' => 'required',
            'hard_disease' => 'required',
            'date' => 'required',
            'how_vaccine' => 'required',
            'offer_date' => 'required',
            'offer_old' => 'required',
        ];
    }

}

