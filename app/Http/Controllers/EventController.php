<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Transformers\EventResource;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    /** @var EventService */

    private $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }



    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        try {
            $events = $this->service->all();
            return $this->ok(EventResource::collection($events));
        } catch (\Throwable $th) {
            return $this->internal_error();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param EventRequest $request
     * @return JsonResponse
     */
    public function store(EventRequest $request): JsonResponse
    {
        try {
            $event = $this->service->store($request->all());
            return $this->created(new EventResource($event));
        } catch (\Throwable $th) {
            return $this->internal_error();
        }
    }
}
