<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\NewAccessToken;

/**
 * @mixin NewAccessToken
 */
class TokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->plainTextToken,
        ];
    }
}
