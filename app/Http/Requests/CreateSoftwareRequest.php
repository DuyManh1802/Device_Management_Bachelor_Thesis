<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSoftwareRequest extends FormRequest
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
            'device_id' => 'required|integer|exists:devices,id',
            'name' => 'required|string',
            'version' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'license_price' => 'required',
            'image' => 'required'
        ];
    }
}
