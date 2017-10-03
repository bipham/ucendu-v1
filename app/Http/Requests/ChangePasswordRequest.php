<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min',
            'password_confirmation' => 'confirm'
        ];
    }
    public function messages() {
        return [
            'password.required' => 'Please enter password',
            'password.min' => 'Password has least 8 characters',
            'password_confirmation.confirm' => 'Passwords Don\'t Match'
        ];
    }
}
