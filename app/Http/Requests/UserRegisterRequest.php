<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRegisterRequest extends Request
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
                    'name_invited' => 'max:255|exists:users,username',
                    'password' => 'required|confirmed|min:4',
                    'email' => 'required|email|max:255|unique:users',
                    'username' => 'required|max:255|unique:users',
                    'password_confirmation' => 'required|same:password'
                ];
    }
}
