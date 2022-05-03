<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository 
{


    public function all()
    {
        $querySet=Event::query();
        return $querySet;
    }
}