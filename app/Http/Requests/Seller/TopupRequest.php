<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class TopupRequest extends FormRequest
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
            "recharge" => "required",
            "amount_submitted" => 'required',
            'images' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:500',
        ];
    }

    public function messages()
    {
        return [
            'images.mimes' => 'The uploaded file must be an image file (jpeg, png, jpg, or svg).',
            'images.max' => 'The uploaded file must not exceed 500KB in size.',
        ];
    }
}
