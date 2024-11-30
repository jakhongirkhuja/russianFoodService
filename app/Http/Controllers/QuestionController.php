<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }
    public function store(StoreQuestionRequest $request)
    {
        $question = $this->questionService->create($request->validated());
        return response()->json($question, 201);
    }

    public function index()
    {
        $question = $this->questionService->getAll();
        return response()->json($question);
    }

    public function show($uuid)
    {
        $question = $this->questionService->getByUuid($uuid);
        return response()->json($question);
    }

    public function update(StoreQuestionRequest $request, $uuid)
    {
        $question = $this->questionService->update($request->validated(), $uuid);
        return response()->json($question);
    }

    // Delete Manufacturer
    public function destroy($uuid)
    {
        $question = $this->questionService->delete($uuid);
        return response()->json(null, 204);
    }
}
