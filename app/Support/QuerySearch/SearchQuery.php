<?php

namespace App\Support\QuerySearch;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * Этот класс создан для автоматическа фильтрация, сортировка и получение relationships
 * В модель укажешь Searchable trait и все.
 * Когда нужно будеть фильтрация или сортировка делать проста вызиваешь Model:search(SearchQuery) и передаещь SearchQuery класс
 */
class SearchQuery implements SearchableQuery
{
    protected Builder $builder;

    public function __construct(protected Request $request)
    {
    }

    public function apply(Builder $builder, string $table): Builder
    {
        $this->builder = $builder;

        $data = $this->request->only('sort', 'include', 'filter');
        foreach ($data as $name => $value) {
            if (method_exists($this, $name) && count($value) > 0) {
                call_user_func_array([$this, $name], [$value, $table]);
            }
        }

        return $this->builder;
    }

    public function sort(array $value, string $table): Builder
    {
        $sorts = array_unique($value);

        foreach ($sorts as $column) {
            $colInTable = ltrim($column, '-+');
            if ($column[0] === '-' && Schema::hasColumn($table, $colInTable)) {
                $this->builder->orderByDesc($colInTable);
            } else if (Schema::hasColumn($table, $colInTable)) {
                $this->builder->orderBy($colInTable);
            }
        }

        return $this->builder;
    }

    public function filter(array $value, string $table): Builder
    {
        $filters = array_unique($value);

        foreach ($filters as $column => $val) {
            [$isLikeSearch, $colInTable] = $this->isLikeSearchColumn($column);
            if ($isLikeSearch && Schema::hasColumn($table, $colInTable)) {
                $this->builder->where($colInTable, 'like', "%$val%");
            } else if (Schema::hasColumn($table, $colInTable)) {
                if (is_array($val)) {
                    $this->builder->whereIn($colInTable, $val);
                } else {
                    $this->builder->where($colInTable, $val);
                }
            }
        }

        return $this->builder;
    }

    public function include(array|string $value): Builder
    {
        if (is_string($value)) {
            $value = explode(',', $value);
        }

        $this->builder->with($value);

        return $this->builder;
    }

    private function isLikeSearchColumn(string $column): array
    {
        if (Str::contains($column, '_like')) {
            return [true, str_replace('_like', '', $column)];
        }

        return [false, $column];
    }
}
