<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class NotePolicy
{
    public function view(User $user, Note $note): Response
    {
        return $user->id === $note->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function update(User $user, Note $note): bool
    {
        return $user->id == $note->user_id;
    }

    public function delete(User $user, Note $note): bool
    {
        return $user->id == $note->user_id;
    }
}
