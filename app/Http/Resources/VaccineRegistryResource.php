<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VaccineRegistryResource extends JsonResource
{
    public function toArray($request)
    : array
    {
        return [
            "id" => $this->id,
            "gender" => $this->gender,
            "age_range" => $this->age_range,
            "province_of_residence" => $this->province_of_residence,
            "city_of_residence" => $this->city_of_residence,
            "vaccinated_in_the_province" => $this->vaccinated_in_the_province,
            "vaccinated_in_the_city" => $this->vaccinated_in_the_city,
            "vaccination_date" => $this->vaccination_date,
            "vaccine" => $this->vaccine,
            "vaccination_condition" => $this->vaccination_condition
        ];
    }
}
