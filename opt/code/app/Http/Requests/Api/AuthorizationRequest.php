<?php

namespace App\Http\Requests\Api;

class AuthorizationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'required|between:3,25||regex:/^[A-Za-z0-9\-\_]+$/|exists:t_users,account',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'account.regex' => '账号只支持英文、数字、横杆和下划线。',
            'account.between' => '用户名必须介于 3 - 25 个字符之间。',
            'password.required' => '账号不能为空。',
            'account.exists' => '账号不存在',
        ];
    }
}
