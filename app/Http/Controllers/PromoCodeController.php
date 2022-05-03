<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromoCodeRequest;
use App\Services\PromoCodeService;
use App\Transformers\PromoCodeResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PromoCodeController extends BaseController
{
    //


    /** @var EventService */
     
    private $service;

    public function __construct(PromoCodeService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $events=$this->service->all();
        return $this->ok(PromoCodeResource::collection($events));
    }


    /**
     * Store a newly created resource in storage.
     * @param PromoCodeRequest $request
     * @return JsonResponse
     */
    public function store(PromoCodeRequest $request): JsonResponse
    {
        $event = $this->service->store($request->all());
        return $this->ok(new PromoCodeResource($event));
    }

}
