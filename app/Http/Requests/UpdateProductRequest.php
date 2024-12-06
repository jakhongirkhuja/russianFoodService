<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'country_import_id' => 'required|exists:countries,id',
            'country_made_in_id' => 'required|exists:countries,id',
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required|numeric',
            'packing' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'body' => 'required|string',
            'type' => 'required|in:xits,new product,favorite',
            'lead'=>'nullable|max:255',
        ];
    }
}
