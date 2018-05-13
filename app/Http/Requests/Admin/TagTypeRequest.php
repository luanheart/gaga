<?php

namespace App\Http\Requests\Admin;


use App\Http\Requests\Api\FormRequest;

class TagTypeRequest extends FormRequest
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
                    'type_name' => 'required|string|unique:tag_types',
                ];
            case 'PATCH':
                return [
                    'type_name' => 'string',
                ];
            default:
                return [];
        }
    }
}
