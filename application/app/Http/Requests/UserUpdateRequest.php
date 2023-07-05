<?php

namespace App\Http\Requests;

use App\Http\Requests\APIFormRequest;

class UserUpdateRequest extends APIFormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|exists:users,email',
            'login' => 'required',
            'password' => 'required|min:6|confirmed'
        ];
    }
}
