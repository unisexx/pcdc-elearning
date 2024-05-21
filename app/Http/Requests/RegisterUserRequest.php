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
            'user_type_id'    => 'required',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'gender_id'       => 'required',
            'age'             => 'nullable|integer|min:0',
            'center_name'     => 'required_if:user_type,1',
            'school_name'     => 'required_if:user_type,2',
            'address_no'      => 'required_if:user_type,1,2,4',
            'village_no'      => 'required_if:user_type,1,2,4',
            'center_phone'    => 'required_if:user_type,1',
            'school_phone'    => 'required_if:user_type,2',
            'province_id'     => 'required_if:user_type,1,2,4',
            'district_id'     => 'required_if:user_type,1,2,4',
            'subdistrict_id'  => 'required_if:user_type,1,2,4',
            'zipcode'         => 'required_if:user_type,1,2,4',
            'affiliation_id'  => 'required_if:user_type,1,2,4',
            'officer_type_id' => 'required_if:user_type,1',
            'area_id'         => 'required_if:user_type,1',
            'position'        => 'required_if:user_type,1,2,4',
            'phone'           => 'required|string|max:15',
            'email'           => 'required|email|max:255',
            'username'        => 'required|string|max:255|unique:users',
            'password'        => 'required|string|min:8|confirmed',
            'terms'           => 'accepted',
        ];
    }

    public function messages()
    {
        return [
            'required'    => 'กรุณาระบุ',
            'max'         => 'Maximum length exceeded.',
            'min'         => 'Minimum length not met.',
            'required_if' => 'This field is required when :other is :value.',
            'unique'      => 'This value has already been taken.',
            'confirmed'   => 'The confirmation does not match.',
            'accepted'    => 'You must accept the terms.',
        ];
    }
}
