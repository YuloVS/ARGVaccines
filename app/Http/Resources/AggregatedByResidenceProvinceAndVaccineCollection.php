<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AggregatedByResidenceProvinceAndVaccineCollection extends ResourceCollection
{
    public function toArray($request)
    : array
    {
        return parent::toArray($request);
    }
}
