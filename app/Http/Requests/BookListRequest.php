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
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'varianttype' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The  name feild is required',
            'description.required' => 'The  description feild is required',
            'author.required' => 'The  authorasd name is must required',
            'price.required' => 'The  price feild is required',
            'images.required' => 'This image type is not allowed !!',
            // 'varianttype.required' => 'This feild is required',
        ];
    }
}
