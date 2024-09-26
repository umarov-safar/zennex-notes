<?php

namespace App\Http\Requests\Notes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreNoteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
           'user_id' => Auth::id()
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:400'],
            'description' => ['required', 'string'],

            // user_id не буду проверить детально потому что данные просто берется из Auth::id().
            // добавил user_id тут потму что в контроллере вызиваю метод validated()
            'user_id' => ['required'],
            'tags' => ['nullable', 'array'],
            'tags.*' => [Rule::exists('tags', 'id')],
        ];
    }
}
