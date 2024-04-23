<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                "id" => (string)$this->id,
                "start_date" => $this->start_date,
                "end_date" => $this->end_date,
                "vehicle" => $this->vehicle,
                "user_id" => 2,
                "user_name" => $this->user->name,
                "total_cost" => $this->total_cost,
                "rental_status" => $this->rental_status,
                "drop_location_name" => $this->dropLocation->name,
                "drop_location_latlon" => $this->dropLocation->latitude. ' '. $this->dropLocation->longitude,
                "pick_location_name" => $this->pickLocation->name,
                "pick_location_latlon" => $this->pickLocation->latitude. ' '. $this->pickLocation->longitude,
                "payment" => $this->payment

        ];
    }
}
