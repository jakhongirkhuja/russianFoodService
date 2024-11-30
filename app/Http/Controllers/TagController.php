<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(): JsonResponse
    {
        $tags = $this->tagService->getAllTags();
        return response()->json($tags,200);
    }

    public function store(TagRequest $request): JsonResponse
    {
        $tag = $this->tagService->createTag($request->validated());
        return response()->json($tag, 201);
    }

    public function show($id): JsonResponse
    {

        return response()->json(Tag::findOrFail($id), 200);
    }

    public function update(TagRequest $request, $id): JsonResponse
    {
        $tag = Tag::findOrFail($id);
       
        return response()->json($this->tagService->updateTag($tag, $request->validated()),200);
    }

    public function destroy($id): JsonResponse
    {
        $tag = Tag::findOrFail($id);
        $this->tagService->deleteTag($tag);
        return response()->json(null,204);
    }
}
