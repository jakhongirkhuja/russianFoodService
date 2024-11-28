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

    public function show(Tag $tag): JsonResponse
    {
        return response()->json($tag, 200);
    }

    public function update(TagRequest $request, Tag $tag): JsonResponse
    {
        $tag = $this->tagService->updateTag($tag, $request->validated());
        return response()->json($tag,200);
    }

    public function destroy(Tag $tag): JsonResponse
    {
        $this->tagService->deleteTag($tag);
        return response()->json(null,204);
    }
}
