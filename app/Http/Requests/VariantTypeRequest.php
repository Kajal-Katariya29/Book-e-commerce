<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariantTypeRequest extends FormRequest
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
            'variant_id' => 'required',
            'variant_type_name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return[
            'variant_id.required' => 'Please select this feild !!',
            'variant_type_name.required' => 'This feild is required !!',
        ];
    }
}
