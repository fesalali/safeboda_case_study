<?php

namespace App\Http\Controllers;

use App\Transformers\EventResource;
use App\Services\EventService;
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
    public function index()
    {
        $events=$this->service->all();
        return $this->ok(EventResource::collection($events));
    }


}
