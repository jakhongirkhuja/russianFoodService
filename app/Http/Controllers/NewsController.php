<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index()
    {
        return response()->json(News::paginate(30));
    }

    public function store(NewsRequest $request)
    {
        $news = $this->newsService->storeNews($request->validated());
        return response()->json($news, Response::HTTP_CREATED);
    }

    public function show($uuid)
    {
        $news = News::where('uuid', $uuid)->firstOrFail();
        return response()->json($news);
    }

    public function update(NewsUpdateRequest $request, $uuid)
    {
        $news = News::where('uuid', $uuid)->firstOrFail();
        $updatedNews = $this->newsService->updateNews($news, $request->validated());
        return response()->json($updatedNews);
    }

    public function destroy($uuid)
    {
        $news = News::where('uuid', $uuid)->firstOrFail();
        $this->newsService->deleteImage($news->image);
        $news->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}