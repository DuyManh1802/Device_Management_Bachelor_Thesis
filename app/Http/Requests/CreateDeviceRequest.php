<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeviceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'integer',
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'required',
            'color' => 'required|string',
            'configuration' => 'required',
            'purchase_price' => 'required',
            'type' => 'required',
            'start' => 'required|date',
            'end' => 'required|date'
        ];
    }
}
