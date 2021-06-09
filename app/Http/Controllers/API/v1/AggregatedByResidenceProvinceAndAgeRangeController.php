<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndAgeRangeCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndAgeRangeResource;
use App\Models\AggregatedByResidenceProvinceAndAgeRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByResidenceProvinceAndAgeRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndAgeRangeCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_residence_province_and_age_ranges"), $request);
        return new AggregatedByResidenceProvinceAndAgeRangeCollection(
            AggregatedByResidenceProvinceAndAgeRangeResource::make($data)
        );
    }
}
