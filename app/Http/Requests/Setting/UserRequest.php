<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'                  => 'ชื่อ',
            // 'lastname'              => 'นามสกุล',
            // 'tel'                   => 'เบอร์โทรศัพท์',
            'email'                 => 'อีเมล์',
            // 'username'              => 'ยูสเซอร์เนม',
            'password'              => 'รหัสผ่าน',
            'password_confirmation' => 'ยืนยันรหัสผ่าน',
        ];
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            // 'lastname' => 'required',
            // 'tel'      => 'required',

        ];

        if ($this->route()->getName() == 'setting.user.store') {
            $rules['email']    = 'required|unique:users,email';
            $rules['password'] = 'required|confirmed|min:6';
        } else {
            $rules['email']    = 'required|unique:users,email,' . $this->route('user');
            $rules['password'] = 'nullable|min:6|confirmed';
        }

        return $rules;
    }
}
