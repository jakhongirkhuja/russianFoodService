<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
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
            'chef_id'=>'required|exists:chefs,uuid',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:500',
            'title' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'body' => 'required|string',
            'cooking_time'=>'required|numieric|min:1',
            'recipe_categories_uuid' => 'required|exists:recipe_categories,uuid',
            'recipe_meal_types_uuid' => 'required|exists:recipe_meal_types,uuid',
            'recipe_product_types_uuid' => 'required|exists:recipe_product_types,uuid',
            'recipe_diet_types_uuid' => 'required|exists:recipe_diet_types,uuid',
        ];
    }
}
