<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveredRequest extends FormRequest
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
            'request_id' => 'integer|exists:requests,id',
            'status' => 'integer',
            'borrowed_date' => 'required|date',
            'return_date' => 'date',
            'device_id' => 'integer'

        ];
    }
}
