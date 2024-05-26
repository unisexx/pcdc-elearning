<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user'); // ดึง userId จากเส้นทาง

        // Rules for create and update form
        $rules = [
            'user_type_id'       => 'required',
            'first_name'         => 'required|max:255',
            'last_name'          => 'required|max:255',
            'gender_id'          => 'required',
            'officer_type_id'    => [
                'required_if:user_type_id,3',
            ],
            'area_id'            => [
                Rule::requiredIf(function () {
                    return $this->input('user_type_id') == 3 && $this->input('officer_type_id') == 1;
                }),
            ],
            'center_name'        => 'required_if:user_type_id,1|max:255',
            'school_name'        => 'required_if:user_type_id,2|max:255',
            'address_no'         => 'required_if:user_type_id,1,2|max:255',
            'village_no'         => 'required_if:user_type_id,1,2|max:255',
            'center_phone'       => 'required_if:user_type_id,1|max:255',
            'school_phone'       => 'required_if:user_type_id,2|max:255',
            'province_id'        => [
                Rule::requiredIf(function () {
                    return !($this->input('user_type_id') == 3 && $this->input('officer_type_id') == 1);
                }),
            ],
            'district_id'        => [
                Rule::requiredIf(function () {
                    return !($this->input('user_type_id') == 3 && ($this->input('officer_type_id') == 1 || $this->input('officer_type_id') == 2));
                }),
            ],
            'subdistrict_id'     => [
                Rule::requiredIf(function () {
                    return !($this->input('user_type_id') == 3 && ($this->input('officer_type_id') == 1 || $this->input('officer_type_id') == 2 || $this->input('officer_type_id') == 3));
                }),
            ],
            'zipcode'            => [
                'max:10',
                Rule::requiredIf(function () {
                    return !($this->input('user_type_id') == 3 && ($this->input('officer_type_id') == 1 || $this->input('officer_type_id') == 2 || $this->input('officer_type_id') == 3));
                }),
            ],
            'affiliation_id'     => 'required_if:user_type_id,1,2',
            'affiliation_other'  => 'required_if:affiliation_id,7|max:255',
            'position'           => 'required_if:user_type_id,1,2,3|max:255',
            'education_level_id' => 'nullable',
            'phone'              => 'required|max:20',
        ];

        if (!empty($userId)) {
            // กรณีเป็นการแก้ไขข้อมูล
            $rules['email']                 = 'nullable|email|max:255|unique:users,email,' . $userId;
            $rules['password']              = 'nullable|min:6';
            $rules['password_confirmation'] = 'nullable|same:password';
        } else {
            // กรณีเป็นการสร้างใหม่
            $rules['email']                 = 'required|email|max:255|unique:users,email,' . $userId;
            $rules['password']              = 'required|min:6';
            $rules['password_confirmation'] = 'required|same:password';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'user_type_id.required'          => 'กรุณาเลือกประเภทผู้ใช้งาน',
            'first_name.required'            => 'กรุณาระบุชื่อ',
            'last_name.required'             => 'กรุณาระบุนามสกุล',
            'gender_id.required'             => 'กรุณาเลือกเพศ',
            'officer_type_id.required_if'    => 'กรุณาเลือกประเภทเจ้าหน้าที่',
            'officer_type_id.in'             => 'ประเภทเจ้าหน้าที่ที่เลือกไม่ถูกต้อง',
            'center_name.required_if'        => 'กรุณาระบุชื่อศูนย์เด็กเล็ก',
            'school_name.required_if'        => 'กรุณาระบุชื่อสถานศึกษา',
            'address_no.required'            => 'กรุณาระบุเลขที่บ้าน',
            'village_no.required'            => 'กรุณาระบุหมู่ที่',
            'center_phone.required_if'       => 'กรุณาระบุเบอร์ติดต่อศูนย์',
            'school_phone.required_if'       => 'กรุณาระบุเบอร์ติดต่อโรงเรียน',
            'province_id.required'           => 'กรุณาเลือกจังหวัด',
            'district_id.required'           => 'กรุณาเลือกเขต/อำเภอ',
            'subdistrict_id.required'        => 'กรุณาเลือกแขวง/ตำบล',
            'zipcode.required'               => 'กรุณากรอกรหัสไปรษณีย์',
            'affiliation_id.required_if'     => 'กรุณาเลือกสังกัด',
            'affiliation_other.required_if'  => 'กรุณาระบุสังกัดอื่นๆ ระบุ',
            'position.required_if'           => 'กรุณาระบุตำแหน่งงาน',
            'phone.required'                 => 'กรุณาระบุหมายเลขเบอร์โทรศัพท์',
            'email.required'                 => 'กรุณาระบุอีเมล',
            'password.required'              => 'โปรดกรอกรหัสผ่าน',
            'password_confirmation.required' => 'กรุณาระบุยืนยันรหัสผ่าน',
            'password_confirmation.same'     => 'รหัสผ่านไม่ตรงกัน',
            'area_id.required'               => 'กรุณาเลือกพื้นที่ เจ้าหน้าที่ประจำเขต',
        ];
    }
}
