<?php

namespace App\Http\Requests\Admin;


use App\Http\Requests\Api\FormRequest;

class UsersRequest extends FormRequest
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
                    'status' => 'required|integer|in:0,1',
                ];
            default:
                return [];
        }
    }
}
