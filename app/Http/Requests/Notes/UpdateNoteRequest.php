<?php

namespace App\Http\Requests\Notes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UpdateNoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:400'],
            'description' => ['sometimes', 'required', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => [Rule::exists('tags', 'id')]
        ];
    }
}
