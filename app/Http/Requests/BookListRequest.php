<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookListRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required',
            'author' => 'required|string|max:100',
            // 'price' => 'required|numeric',
            // 'images' => 'image|required|mimes:jpeg,png,gif,jpg|max:2048',
            // 'variant_id' => 'required',
            // 'variant_type_name' => 'required',
            // 'category_name' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The  name feild is required !!',
            'description.required' => 'The  description feild is required !!',
            'author.required' => 'The  author name is must required !!',
            'price.required' => 'The  price feild is required !!',
            // 'images.required' => 'This feild is required !!',
            // 'variant_id.required' => 'Please select variant name !!',
            // 'variant_type_name.required' => 'Please select variant type name !!',
            'category_name.required' => 'Please Select this feild !!'
        ];
    }
}
