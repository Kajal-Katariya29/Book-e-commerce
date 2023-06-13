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
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The 1 name feild is required',
            'description.required' => 'The 1 description feild is required',
            'author.required' => 'The 1 authorasd name is must required',
            'price.required' => 'The 1 price feild is required',
        ];
    }
}
