<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TotalDosesResource extends JsonResource
{
    public function toArray($request)
    {
        $totalDosesByLocation = [];
        foreach($this->resource as $item)
        {
            array_push($totalDosesByLocation, array_filter([
                "province" => $item->province,
                "total_first_doses" => $item->total_first_dose,
                "total_second_doses" => $item->total_second_dose
            ]));
        }
        return array_filter($totalDosesByLocation);
    }
}
