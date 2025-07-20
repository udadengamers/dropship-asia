<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => $this->id ? 'required|unique:shops,name,'.$this->id : 'required|unique:shops,name',
            'profile' => $this->id ? 'sometimes|image|mimes:jpeg,png,jpg,gif|max:500' : 'required|image|mimes:jpeg,png,jpg,gif|max:500',
        ];
        return [
            'shop_name' => $rules['name'],
            'id_card' => 'required',
            'shop_phone_number' => 'required',
            'contact_person_name' => 'required',
            'supplier_name' => 'sometimes',
            'invitation_code' => 'sometimes',
            'payment_method' => 'sometimes',
            'merchant_category' => 'sometimes',
            'shop_address' => 'required',
            'shop_profile_picture' => $rules['profile'],
            'business_license' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:500',
        ];
    }

    public function messages()
    {
        return [
            'shop_profile_picture.mimes' => 'The uploaded file must be an image file (jpeg, png, jpg, or svg).',
            'shop_profile_picture.max' => 'The uploaded file must not exceed 500KB in size.',
        ];
    }
}
