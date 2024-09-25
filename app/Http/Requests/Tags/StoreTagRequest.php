<?php

namespace App\Http\Requests\Tags;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTagRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags')->where(function (Builder $query){
                    return $query->where('name', $this->input('name'))
                        ->where('user_id', $this->input('user_id'));
                })
            ],
            'user_id' => ['required']
        ];
    }
}
