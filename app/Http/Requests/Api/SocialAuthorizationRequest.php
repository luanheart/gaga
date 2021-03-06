<?php

namespace App\Http\Requests\Api;


class SocialAuthorizationRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'code' => 'required_without:access_token|string',
            'access_token' => 'required_without:code|string',
        ];

        if ($this->social_type = 'mini_program') {
            $rules['iv'] = 'required';
            $rules['encryptedData'] = 'required';
        }

        return $rules;
    }
}
