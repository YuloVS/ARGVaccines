<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByAgeRangeCollection;
use App\Http\Resources\AggregatedByAgeRangeResource;
use App\Models\AggregatedByAgeRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByAgeRangeController extends Controller
{
    public function index(Request $request)
    : AggregatedByAgeRangeCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_age_ranges"), $request);
        return new AggregatedByAgeRangeCollection(
            AggregatedByAgeRangeResource::make($data)
        );
    }
}
