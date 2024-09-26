<?php

namespace App\Models;

use App\Support\QuerySearch\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
      'title',
      'description',
      'user_id'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'note_tag');
    }
}
