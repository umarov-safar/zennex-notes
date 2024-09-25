<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TagPolicy
{
    public function view(User $user, Tag $tag): Response
    {
        return $user->id === $tag->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function update(User $user, Tag $tag): bool
    {
        return $user->id === $tag->user_id;
    }


    public function delete(User $user, Tag $tag): bool
    {
        return $user->id === $tag->user_id;
    }

}
