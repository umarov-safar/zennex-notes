<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CommonSearchRequest extends FormRequest
{
    public function rules()
    {
        return [
          'include' => ['nullable', 'array'],
          'filter' => ['nullable', 'array'],
          'sort' => ['nullable', 'array']
        ];
    }

    public function getFilter()
    {
        return $this->input('filter');
    }

    public function getInclude()
    {
        return $this->input('include');
    }

    public function getSort()
    {
        return $this->input('sort');
    }
}
