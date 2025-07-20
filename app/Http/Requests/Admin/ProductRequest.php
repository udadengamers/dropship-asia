<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'quantity' => $this->stock ? 'sometimes' : ['required','numeric','min:1'],
            'price' => $this->stock ? 'sometimes' : ['required','numeric','min:0.1'],
        ];
        return [
            'name' => ['required'],
            'sku' => ['required'],
            'categories' => ['required'],
            'description' => ['required'],
            'images.*' => ['required',
                // 'image','mimes:jpeg,png,jpg,gif,svg',
                'max:500'],
            'quantity' => $rules['quantity'],
            'price' => $rules['price'],
            'stock.*.quantity' => $this->stock ? ['numeric','min:1'] : [''],
            'stock.*.price' => $this->stock ? ['numeric','min:0.1'] : [''],
        ];
    }
    
    public function messages(): array
    {
        return [
            'images.*.max' => 'Image must not be greater than 500 kilobytes.',
        ];
    }
}
