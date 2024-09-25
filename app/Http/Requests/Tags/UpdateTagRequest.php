<?php

namespace App\Http\Requests\Tags;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    public function rules(): array
    {
        $tagId = $this->route('tag.id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags')->where(function (Builder $query){
                    return $query->where('name', $this->input('name'))
                        ->where('user_id', Auth::id());
                })->ignore($tagId)
            ],
        ];
    }
}
