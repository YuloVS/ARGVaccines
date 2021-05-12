<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QtyByLocationResource extends JsonResource
{
    public function toArray($request)
    : array
    {
        return [
            "id" => $this->id,
            "province" => $this->province,
            "vaccine" => $this->vaccine,
            "first_dose" => $this->first_dose,
            "second_dose" => $this->second_dose
        ];
    }
}
