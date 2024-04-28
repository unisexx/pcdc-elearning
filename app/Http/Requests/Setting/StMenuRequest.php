<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class StMenuRequest extends FormRequest
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
            'name' => 'ชื่อเมนู',
            'radio' => 'ประเภทเมนุ',
            'controller' => 'controller',
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'radio' => 'required',
            'controller' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'status_id' => $this->input('status_id', '0'),
        ]);

    }
}

