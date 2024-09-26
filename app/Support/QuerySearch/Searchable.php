<?php

namespace App\Support\QuerySearch;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, SearchableQuery $searchQuery): Builder
    {
        return $searchQuery->apply($query, $this->getTable());
    }
}
