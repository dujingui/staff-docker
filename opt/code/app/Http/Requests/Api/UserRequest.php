<?php

namespace App\Http\Requests\Api;

class UserRequest extends FormRequest
{
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'account' => 'required|between:3,25||regex:/^[A-Za-z0-9\-\_]+$/|unique:t_users,account',
                    'password' => 'required|string|min:6',
                ];
                break;
            case 'PATCH':
                // $userId = auth('api')->id();
                return [
                    'gender' => 'integer|required',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'verification_key' => '短信验证码 key',
            'verification_code' => '短信验证码',
        ];
    }

    public function messages()
    {
        return [
            'account.unique' => '账号已注册，请重新填写',
            'account.regex' => '账号只支持英文、数字、横杆和下划线。',
            'account.between' => '用户名必须介于 3 - 25 个字符之间。',
            'password.required' => '账号不能为空。',
        ];
    }
}
