<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notes\StoreNoteRequest;
use App\Http\Requests\Notes\UpdateNoteRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\NoteResource;
use App\Http\Services\NoteService;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(
        private readonly NoteService $noteService
    )
    {
    }

    public function index()
    {
        // will start when thinking about sort,filter
    }

    public function store(StoreNoteRequest $request): NoteResource
    {
        return new NoteResource($this->noteService->upsert($request->validated()));
    }

    public function show(Note $note): NoteResource
    {
        $this->authorize('view', $note);

        return new NoteResource($note);
    }


    public function update(UpdateNoteRequest $request, Note $note): NoteResource
    {
        $this->authorize('update', $note);

        return new NoteResource($this->noteService->upsert($request->validated(), $note));
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $this->noteService->destroy($note);

        return new EmptyResource();
    }
}
