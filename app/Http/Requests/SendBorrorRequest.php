<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendBorrorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer',
            'department_id' => 'required|integer|exists:departments,id',
            'type' => 'required|integer',
            'start_date' => 'required|date',
            'note' => 'string|between:0,100'
        ];
    }
}
