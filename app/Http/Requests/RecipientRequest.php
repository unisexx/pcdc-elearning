<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientRequest extends FormRequest
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
            'doc[birth_plate]' => 'สถานที่เกิด',
            'doc[first_name]' => 'ชื่อ',
            'doc[last_name]' => 'นามสกุล',
            'doc[tel]' => 'เบอร์โทรศัพท์',
            'doc[occupation]' => 'อาชีพ',
            'doc[disable_type_id]' => 'ประเภทความพิการ',
            'doc[income]' => 'รายได้',
            'doc[defect]' => 'ตำหนิรูปพรรณสัณฐาน',
            'doc1[no]' => 'บ้านเลขที่',
            'doc1[road]' => 'ถนน',
            'doc1[code]' => 'รหัสไปรษณีย์',
            'doc3[edu_year]' => 'ปีที่จบการศึกษา',
            'doc3[edu_plate]' => 'สถานศึกษาที่สำเร็จการศึกษา',
            'doc4[first_name]' => 'ชื่อ',
            'doc4[last_name]' => 'นามสกุล',
            'doc4[tel]' => 'เบอร์โทรศัพท์',
        ];
    }

    public function rules()
    {
        return [
            'doc[birth_plate]' => 'required',
            'doc[first_name]' => 'required',
            'doc[last_name]' => 'required',
            'doc[tel]' => 'required',
            'doc[occupation]' => 'required',
            'doc[disable_type_id]' => 'required',
            'doc[income]' => 'required',
            'doc[defect]' => 'required',
            'doc1[no]' => 'required',
            'doc1[road]' => 'required',
            'doc1[code]' => 'required',
            'doc3[edu_year]' => 'required',
            'doc3[edu_plate]' => 'required',
            'doc4[first_name]' => 'required',
            'doc4[last_name]' => 'required',
            'doc4[tel]' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'status_id' => $this->input('status_id', '0'),
        ]);

    }
}
