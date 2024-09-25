<?php

namespace App\Http\Services;

use App\Models\Note;

class NoteService
{
    // Этот метод либо создает заметки, либо изменяет существующие.
    public function upsert(array $data, Note $note = null): Note
    {
        return Note::updateOrCreate(
            ['id' => $note?->id],
            $data
        );
    }

    public function destroy(Note $note)
    {
        $note->delete();
    }
}
