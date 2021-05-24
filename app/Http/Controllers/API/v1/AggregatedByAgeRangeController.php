<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByAgeRangeCollection;
use App\Http\Resources\AggregatedByAgeRangeResource;
use App\Models\AggregatedByAgeRange;
use Illuminate\Http\Request;

class AggregatedByAgeRangeController extends Controller
{
    public function index(Request $request)
    : AggregatedByAgeRangeCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByAgeRange::query(),$request);
        return new AggregatedByAgeRangeCollection(
            AggregatedByAgeRangeResource::make($query->get())
        );
    }
}
