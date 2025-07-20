<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserRequest extends FormRequest
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
        $rules = $this->id ? 'required|unique:users,id,' . $this->id : 'required|unique:users';

        return [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => $rules,
            'phone' => $rules,
            'wallet_address' => 'required',
            'state' => 'required',
            'date_of_birth' => 'required',
            'address_one' => 'required',
            'address_two' => 'required',
        ];
    }
}
