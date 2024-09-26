<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\StoreTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\TagResource;
use App\Http\Services\TagService;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function __construct(
        private readonly TagService $tagService
    )
    {
    }

    public function index()
    {
        return TagResource::collection($this->tagService->paginateForCurrentUser(Auth::id()));
    }

    public function store(StoreTagRequest $request)
    {
        return new TagResource($this->tagService->upsert($request->validated()));
    }


    public function show(Tag $tag)
    {
        $this->authorize('view', $tag);

        return new TagResource($tag->load('notes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $this->authorize('update', $tag);

        return new TagResource($this->tagService->upsert($request->validated(), $tag));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        $this->tagService->destroy($tag);

        return new EmptyResource();
    }
}
