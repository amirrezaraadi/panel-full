<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check() === true ;
    }

    public function rules(): array
    {
        return [
            'comment' => ['required', 'string', 'min:5'],
            'comment_id' => ['nullable', 'exists:comments,id', 'integer'],
        ];
    }
}
