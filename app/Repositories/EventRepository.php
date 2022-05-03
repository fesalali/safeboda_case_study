<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventDefinition;

class EventRepository
{


    public function all()
    {
        $querySet = Event::query();
        return $querySet;
    }

    public function store($arr): array
    {

        return [
            EventDefinition::NAME => $arr[EventDefinition::NAME],
            EventDefinition::LON => $arr[EventDefinition::LON],
            EventDefinition::LAT => $arr[EventDefinition::LAT]
        ];
    }
}
