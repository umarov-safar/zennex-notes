<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Responsable;

class EmptyResource implements Responsable
{
    public function toResponse($request)
    {
        return response(['data' => null]);
    }
}
