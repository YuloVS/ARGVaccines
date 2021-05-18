<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AggregatedByResidenceProvinceAndAgeRangeCollection extends ResourceCollection
{
    public function toArray($request)
    : array
    {
        return parent::toArray($request);
    }
}
