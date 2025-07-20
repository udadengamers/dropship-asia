<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
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
        $rules = [
            'amount_approved' => $this->btn == 'rejected' ? 'sometimes' : 'required',
            'proof_file_path' => $this->btn == 'rejected' ? 'sometimes' : 'required',
        ];
        return [
            "amount_approved" => $rules['amount_approved'],
            'proof_file_path' => $rules['proof_file_path'] .'|image|mimes:jpeg,png,jpg,gif|max:500',
        ];
    }
}
