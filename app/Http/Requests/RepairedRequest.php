<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepairedRequest extends FormRequest
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
            'type' => 'integer',
            'repair_id' => 'integer|exists:repairs,id',
            'result' => 'required|string',
            'content' => 'required|string',
            'cost' => 'required|integer'
        ];
    }
}
