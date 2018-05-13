<?php

namespace App\Http\Requests\Admin;


use App\Http\Requests\Api\FormRequest;

class AdministratorRequest extends FormRequest
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
                    'username' => 'required|string|unique:administrators',
                    'password' => 'required|string'
                ];
            case 'PATCH':
                return [
                    'password' => 'required|string'

                ];
            default:
                return [];
        }
    }
}
