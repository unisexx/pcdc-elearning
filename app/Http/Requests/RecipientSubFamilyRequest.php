<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientSubFamilyRequest extends FormRequest
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
            'first_name' => 'ชื่อ',
            'last_name' => 'นามสกุล',
            'status' => 'สถานะการมีชีวิตอยู่',
            'occupation' => 'อาชีพ',
            'st_race_id' => 'เชื้อชาติ',
            'st_nationality_id' => 'สัญชาติ',
            'st_relation_id' => 'ความสัมพันธ์กับผู้รับบริการ',
            'st_religion_id' => 'ศาสนา',
            'birthdate' => 'วันเกิด',
            'income' => 'รายได้',
            'line_id' => 'LineId',
            'tel' => 'เบอร์โทรศัพท์',
            'no' => 'บ้านเลขที่',
            'road' => 'ถนน',
            'st_province_id' => 'จังหวัด',
            'st_district_id' => 'อำเภอ',
            'st_sub_district_id' => 'ตำบล',
            'code' => 'รหัสไปรษณีย์',
            'healthy' => 'สุขภาพ',
            'school' => 'ชื่อโรงเรียน (พี่น้อง)',
            'st_education_level_id' => 'ระดับการศึกษา',
            'charactor' => 'อุปนิสัย',
            'healthy_all' => 'สุขภาพร่างการและจิตใจ',
            'number_step_child' => 'จำนวนบุตรที่ติดมากับสามีหรือภรรยา',
            'number_child' => 'จำนวนบุตร',
            'to_child' => 'ความรู้สึกที่มีต่อเด็ก',
            'parent_status' => 'สถานะสมรสระหว่างบิดา-มารดา',
            'father_status' => 'สถานะครอบครัวปัจจุบันของบิดา',
            'mother_status' => 'สถานะครอบครัวปัจจุบันของมารดา',
            'child_status' => 'สถานะครอบครัวของเด็ก',
            'relation_status' => 'สถานะความสัมพันกับญาติ-ผู้ปกครอง',

        ];
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'status' => 'required',
            'occupation' => 'required',
            'st_race_id' => 'required',
            'income' => 'required',
            'line_id' => 'required',
            'tel' => 'required',
            'no' => 'required',
            'road' => 'required',
            'code' => 'required',
            'healthy' => 'required',
            'school' => 'required',
            'charactor' => 'required',
            'healthy_all' => 'required',
            'number_step_child' => 'required',
            'number_child' => 'required',
            'to_child' => 'required',
            'parent_status' => 'required',
            'father_status' => 'required',
            'mother_status' => 'required',
            'child_status' => 'required',
            'relation_status' => 'required',
            'st_nationality_id' => 'required',
            'st_relation_id' => 'required',
            'st_religion_id' => 'required',
            'birthdate' => 'required',
            'st_province_id' => 'required',
            'st_district_id' => 'required',
            'st_sub_district_id' => 'required',
            'st_education_level_id' => 'required',
        ];
    }

}

