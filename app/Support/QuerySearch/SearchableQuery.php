<?php

namespace App\Support\QuerySearch;

use Illuminate\Database\Eloquent\Builder;

interface SearchableQuery
{
    public function apply(Builder $builder, string $table): Builder;

    public function sort(array $value, string $table): Builder;

    public function filter(array $value, string $table): Builder;

    public function include(array $value): Builder;
}
