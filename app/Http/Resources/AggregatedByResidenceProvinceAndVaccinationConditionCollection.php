<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AggregatedByResidenceProvinceAndVaccinationConditionCollection extends ResourceCollection
{
    public function toArray($request)
    : array
    {
        return parent::toArray($request);
    }
}
