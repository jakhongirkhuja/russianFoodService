<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class FormSubmit extends FormRequest
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
            'name'=>'required|min:2|max:200',
            'email' => [
                    'nullable', 
                    'email',   
                    Rule::requiredIf($this->input('type') === 'contact_page'), // Required if type is contact_page
                ],
            'message'=>'required|min:10|max:1000',
            'type'=>'required|in:contact_page,product_page',
            'phone' => [
                Rule::requiredIf($this->input('type') === 'product_page'),
                'regex:/^[0-9]{12}$/', // Exactly 12 digits
            ],
        ];
    }
}
