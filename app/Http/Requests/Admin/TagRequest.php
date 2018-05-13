<?php

namespace App\Http\Requests\Admin;


use App\Http\Requests\Api\FormRequest;

class TagRequest extends FormRequest
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
                    'name' => 'required|string|unique:tags',
                    'type' => 'integer|exist:tag_types,id'
                ];
            case 'PATCH':
                return [
                    'name' => 'string',
                    'type' => 'integer|exist:tag_types,id'

                ];
            default:
                return [];
        }
    }
}
