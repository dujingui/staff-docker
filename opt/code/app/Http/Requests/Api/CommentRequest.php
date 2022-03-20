<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'content' => 'required|string',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'content.required' => 'content不能为空。',
        ];
    }
}
