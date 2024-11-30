<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        return response()->json($this->eventService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->eventService->getByUUid($id));
    }

    public function store(EventRequest $request)
    {
        $event = $this->eventService->create($request->validated());

        return response()->json($event, 201);
    }

    public function update(UpdateEventRequest $request, $uuid)
    {
      
        $event = $this->eventService->update($this->eventService->getByUUid($uuid), $request->validated());

        return response()->json( $event);
    }

    public function destroy( $uuid)
    {
        $this->eventService->delete($this->eventService->getByUUid($uuid));

        return response()->json(null,204);
    }
}
