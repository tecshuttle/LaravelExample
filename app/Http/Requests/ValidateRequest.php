<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ValidateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:5',
            'old' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请填写姓名',
            'name.max' => '姓名不能超过:max个字符',
            'old.required' => '我们需要知道你的年龄',
        ];
    }
}
