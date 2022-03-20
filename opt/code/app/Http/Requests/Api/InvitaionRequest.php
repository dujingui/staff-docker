<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class InvitaionRequest extends FormRequest
{
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'title' => 'required|string',
                    'content_text' => 'required|string',
                ];
                break;
        }
    }


    public function messages()
    {
        return [
            'title.required' => 'title不能为空。',
            'content_text.required' => 'content_text不能为空。',
        ];
    }
}
