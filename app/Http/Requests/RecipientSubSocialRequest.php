<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientSubSocialRequest extends FormRequest
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
            'social_name' => 'ชื่อนักสังคมสงเคราะห์',

        ];
    }

    public function rules()
    {
        return [
            'social_name' => 'required',

        ];
    }

}
