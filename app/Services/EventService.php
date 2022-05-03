<?php

namespace App\Services;

use App\Repositories\EventRepository;
use Exception;

class EventService
{


    protected $eventRepository;

    /**
     * BaseService constructor.
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
}