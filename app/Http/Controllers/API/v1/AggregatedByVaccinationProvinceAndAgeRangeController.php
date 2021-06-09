<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndAgeRangeCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndAgeRangeResource;
use App\Models\AggregatedByVaccinationProvinceAndAgeRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByVaccinationProvinceAndAgeRangeController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationProvinceAndAgeRangeCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_vaccination_province_and_age_ranges"), $request);
        return new AggregatedByVaccinationProvinceAndAgeRangeCollection(
            AggregatedByVaccinationProvinceAndAgeRangeResource::make($data)
        );
    }
}
