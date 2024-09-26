<?php

namespace App\Http\Services;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class NoteService
{
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
