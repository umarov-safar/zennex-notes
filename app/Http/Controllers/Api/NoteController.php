<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonSearchRequest;
use App\Http\Requests\Notes\StoreNoteRequest;
use App\Http\Requests\Notes\UpdateNoteRequest;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\NoteResource;
use App\Http\Services\NoteService;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function __construct(
        private readonly NoteService $noteService
    )
    {
    }

    public function index(CommonSearchRequest $request)
    {
        $request->merge(['user_id' => Auth::id()]);

        $notes = $this->noteService->search($request);

        return NoteResource::collection($notes);
    }

    public function store(StoreNoteRequest $request): NoteResource
    {
        return new NoteResource($this->noteService->upsert($request->validated()));
    }

    public function show(Request $request, Note $note): NoteResource
    {
        $this->authorize('view', $note);

        if ($include = $request->query->get('include')) {
            $note->load(explode(',', $include));
        }

        return new NoteResource($note);
    }

    public function update(UpdateNoteRequest $request, Note $note): NoteResource
    {
        $this->authorize('update', $note);

        $data = $request->validated();
        $data['user_id'] = Auth::id();

        return new NoteResource($this->noteService->upsert($data, $note));
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $this->noteService->destroy($note);

        return new EmptyResource();
    }
}
