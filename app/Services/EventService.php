<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;
use Exception;

class EventService
{


    protected $eventRepository;

    /**
     * EventService constructor.
     * @param EventRepository $EventRepository Model's Event Repository
     * @throws Exception
     */
    public function __construct(EventRepository $eventRepository)
    {
        if ($eventRepository == null)
            throw new Exception('Fatal Error, Event Repository Is Required');

        $this->eventRepository = $eventRepository;
    }

    public function all()
    {
        return $this->eventRepository->all()->get();

    }

    public function store($arr)
    {

        $returnValue = Event::create(
            $this->eventRepository->store($arr)
        );

        return $returnValue;

    }
}