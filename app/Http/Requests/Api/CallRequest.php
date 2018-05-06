<?php

namespace App\Http\Requests\Api;


class CallRequest extends FormRequest
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
                    'target_user_id' => 'required|exists:users,id',
                ];
            default:
                return [];
        }
    }
}
