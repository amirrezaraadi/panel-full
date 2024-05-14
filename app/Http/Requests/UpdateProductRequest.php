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
            'title' => ['required' , 'string' , 'min:3' , 'max:255'],
            'title_en' => ['required' , 'string' , 'min:3' , 'max:255'],
            'body' => ['required' , 'string' , 'min:3' , 'max:1024'],
            'price' => ['required' ,  'regex:^[1-9][0-9]+|not_in:0'],
        ];
    }
}
