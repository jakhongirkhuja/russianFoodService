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
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'country_import_id' => 'required|exists:countries,id',
            'country_madeIn_id' => 'required|exists:countries,id',
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required|numeric',
            'packing' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'body' => 'required|string',
            'type' => 'required|in:xits,new product,favorite',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ];
    }
}
