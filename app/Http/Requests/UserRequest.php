<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class UserRequest extends Request
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
        $user = $this->route('user');
        return [
                    'name_invited' => 'required|max:255|exists:users,username',
                    'name' => 'required',
                    'role_id' => 'required',
                    'email' => 'required|unique:users,email,'.$user->id
                ];
    }
}
