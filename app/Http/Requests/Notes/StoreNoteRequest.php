<?php

namespace App\Http\Requests\Notes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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

            // тут не буду проверить детально потому что данные просто берется из Auth.
            // добавиль user_id тут потму что в контроллере вызиваю метод validated()
            'user_id' => ['required']
        ];
    }
}
