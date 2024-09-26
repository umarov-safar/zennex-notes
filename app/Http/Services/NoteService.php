<?php

namespace App\Http\Services;

use App\Http\Requests\CommonSearchRequest;
use App\Models\Note;
use App\Models\Tag;
use App\Support\QuerySearch\Searchable;
use App\Support\QuerySearch\SearchQuery;
use Illuminate\Database\Eloquent\Builder;

class NoteService
{
    public function search(CommonSearchRequest $request)
    {
        /** @var Builder $notes */
        $notes = Note::where('user_id', $request->input('user_id'));

        $tags = $request->getFilter()['tags'] ?? null;
        if ($tags) {
            $notes->whereHas('tags', function ($query) use ($tags) {
               return $query->whereIn('tags.id', $tags);
            });
        }
        /**
         * @see Searchable::scopeSearch()
         */
        return $notes
            ->search(resolve(SearchQuery::class))
            ->cursorPaginate();
    }

    // Этот метод либо создает заметки, либо изменяет существующие.
    public function upsert(array $data, Note $note = null): Note
    {
        /** @var Note $note */
        $note = Note::updateOrCreate(
            ['id' => $note?->id],
            $data
        );

        if (isset($data['tags']) && $data['tags']) {
            // Быть увереном что связ не будет с тегом другого пользователя
            $tagIds = Tag::query()->where('user_id', $data['user_id'])
                ->whereIn('id', $data['tags'])
                ->pluck('id')
                ->toArray();

            if ($tagIds) {
                $note->tags()->sync($tagIds);
            }
        }

        return $note;
    }

    public function destroy(Note $note)
    {
        $note->delete();
    }
}
