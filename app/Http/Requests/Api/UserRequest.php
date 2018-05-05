<?php

namespace App\Http\Requests\Api;


class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PATCH':
                return [
                    'nickname' => 'string|max:255',
                    'avatar' => 'string',
                    'birthday' => 'date',
                    'sex' => 'integer|in:0,1,2',
                    'height' => 'integer',
                    'weight' => 'integer',
                    'attribute' => 'integer',
                    'wechat' => 'string|max:255',
                    'wechat_img' => 'string|max:255',
                    'job' => 'string|max:255',
                    'income' => '',
                    'constellation' => 'string',
                    'blood_type' => 'string',
                    'emotion' => 'integer|in:0,1,2,3,4',
                    'introduction' => 'string|max:255',
                    'country' => 'string',
                    'province' => 'string',
                    'city' => 'string',
                ];
            default:
                return [];
        }
    }
}
