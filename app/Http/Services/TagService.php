<?php

namespace App\Http\Services;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagService
{
    public function paginateForCurrentUser(int $user_id, string $cursor = null)
    {
        /** @var Builder $tags */
        $tags = Tag::where('user_id', $user_id);

        return $tags->cursorPaginate(30);

    }

    public function upsert(array $data, Tag $note = null): Tag
    {
        return Tag::updateOrCreate(
            ['id' => $note?->id],
            $data
        );
    }

    public function destroy(Tag $note)
    {
        $note->delete();
    }
}
