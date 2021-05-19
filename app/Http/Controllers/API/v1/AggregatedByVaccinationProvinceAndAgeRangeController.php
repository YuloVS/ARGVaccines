<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndAgeRangeCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndAgeRangeResource;
use App\Models\AggregatedByVaccinationProvinceAndAgeRange;
use Illuminate\Http\Request;

class AggregatedByVaccinationProvinceAndAgeRangeController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationProvinceAndAgeRangeCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByVaccinationProvinceAndAgeRange::query(), $request);
        return new AggregatedByVaccinationProvinceAndAgeRangeCollection(
            AggregatedByVaccinationProvinceAndAgeRangeResource::make($query->get())
        );
    }
}
