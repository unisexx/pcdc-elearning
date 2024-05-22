<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_type_id'       => 'required|integer|in:1,2,3,4',
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'gender_id'          => 'required|integer|in:1,2,3',
            'officer_type_id'    => 'nullable|integer|in:1,2,3,4',
            'area_id'            => 'nullable|integer',
            'center_name'        => 'required_if:user_type_id,1|string|max:255',
            'school_name'        => 'required_if:user_type_id,2|string|max:255',
            'address_no'         => 'required|string|max:255',
            'village_no'         => 'required|string|max:255',
            'center_phone'       => 'required_if:user_type_id,1|string|max:255',
            'school_phone'       => 'required_if:user_type_id,2|string|max:255',
            'province_id'        => 'required|integer',
            'district_id'        => 'required|integer',
            'subdistrict_id'     => 'required|integer',
            'zipcode'            => 'required|string|max:10',
            'affiliation_id'     => 'required|integer|in:1,2,3,4,5,6,7',
            'affiliation_other'  => 'required_if:affiliation_id,7|string|max:255',
            'position'           => 'required|string|max:255',
            'education_level_id' => 'nullable|integer|in:1,2',
            'phone'              => 'required|string|max:20',
            'email'              => 'required|string|email|max:255|unique:users',
            'username'           => 'required|string|max:255|unique:users',
            'password'           => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'user_type_id.required'         => 'กรุณาเลือกประเภทผู้ใช้งาน',
            'first_name.required'           => 'กรุณาระบุชื่อ',
            'last_name.required'            => 'กรุณาระบุนามสกุล',
            'gender_id.required'            => 'กรุณาเลือกเพศ',
            'center_name.required_if'       => 'กรุณาระบุชื่อศูนย์เด็กเล็ก',
            'school_name.required_if'       => 'กรุณาระบุชื่อสถานศึกษา',
            'address_no.required'           => 'กรุณาระบุเลขที่บ้าน',
            'village_no.required'           => 'กรุณาระบุหมู่ที่',
            'center_phone.required_if'      => 'กรุณาระบุเบอร์ติดต่อศูนย์',
            'school_phone.required_if'      => 'กรุณาระบุเบอร์ติดต่อโรงเรียน',
            'province_id.required'          => 'กรุณาเลือกจังหวัด',
            'district_id.required'          => 'กรุณาเลือกเขต/อำเภอ',
            'subdistrict_id.required'       => 'กรุณาเลือกแขวง/ตำบล',
            'zipcode.required'              => 'กรุณากรอกรหัสไปรษณีย์',
            'affiliation_id.required'       => 'กรุณาเลือกสังกัด',
            'affiliation_other.required_if' => 'กรุณาระบุสังกัดอื่นๆ ระบุ ',
            'position.required'             => 'กรุณาระบุตำแหน่งงาน',
            'phone.required'                => 'กรุณากรอกหมายเลขเบอร์โทรศัพท์',
            'email.required'                => 'กรุณากรอกอีเมล',
            'username.required'             => 'โปรดระบุชื่อผู้ใช้งาน Username',
            'password.required'             => 'โปรดกรอกรหัสผ่าน',
            'password.confirmed'            => 'รหัสผ่านไม่ตรงกัน',
        ];
    }
}
