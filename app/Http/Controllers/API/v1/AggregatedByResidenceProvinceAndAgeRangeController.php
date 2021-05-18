<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndAgeRangeCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndAgeRangeResource;
use App\Models\AggregatedByResidenceProvinceAndAgeRange;
use Illuminate\Http\Request;

class AggregatedByResidenceProvinceAndAgeRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndAgeRangeCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByResidenceProvinceAndAgeRange::query(), $request);
        return new AggregatedByResidenceProvinceAndAgeRangeCollection(
            AggregatedByResidenceProvinceAndAgeRangeResource::make(
                $query->get()
            )
        );
    }
}
