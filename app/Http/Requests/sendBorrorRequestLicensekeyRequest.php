<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sendBorrorRequestLicensekeyRequest extends FormRequest
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
            'user_id' => 'integer|exists:users,id',
            'type' => 'required|integer',
            'note' => 'required|string',
            'start_date' => 'required',
            'device_id' => 'integer'
        ];
    }
}
