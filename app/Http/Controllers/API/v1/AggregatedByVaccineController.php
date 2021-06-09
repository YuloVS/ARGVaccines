<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccineCollection;
use App\Http\Resources\AggregatedByVaccineResource;
use App\Models\AggregatedByVaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByVaccineController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccineCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_vaccines"), $request);
        return new AggregatedByVaccineCollection(
            AggregatedByVaccineResource::make($data)
        );
    }
}
