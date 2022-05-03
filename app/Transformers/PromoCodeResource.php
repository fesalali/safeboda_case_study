<?php

namespace App\Transformers;

use App\Models\PromoCodeDefinition;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromoCodeResource extends JsonResource
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
            PromoCodeDefinition::ID => $this->id,
            PromoCodeDefinition::EVENT_ID => $this->event_id,
            PromoCodeDefinition::CODE => $this->code,
            PromoCodeDefinition::AVAILABLE_COUNT => $this->available_count,
            PromoCodeDefinition::IS_ACTIVE => $this->is_active,
            PromoCodeDefinition::EXPIRATION_DATE => $this->expiration_date,
        ];
    }
}
