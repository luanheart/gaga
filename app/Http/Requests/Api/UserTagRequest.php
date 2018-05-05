<?php

namespace App\Http\Requests\Api;


class UserTagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'tag_ids' => 'json',
                    'dream_ids' => 'json'
                ];
            default:
                return [];
        }
    }
}
