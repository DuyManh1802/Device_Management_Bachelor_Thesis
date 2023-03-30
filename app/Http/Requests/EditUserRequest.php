<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email|max:100, {$this->user->id}",
            'address' => 'required|string|max:255',
            'phone' => 'required|regex:/(0)[0-9]{0,10}/',
            'role' => 'required|integer|max:2',
            'image' => 'required'
        ];
    }
}
