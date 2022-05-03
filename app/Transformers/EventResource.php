<?php

namespace App\Transformers;

use App\Models\EventDefinition;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            EventDefinition::ID => $this->id,
            EventDefinition::NAME=> $this->name,
            EventDefinition::LAT => $this->lat,
            EventDefinition::LON=> $this->lon
        ];
    }
}
