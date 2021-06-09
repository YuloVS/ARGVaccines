<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationConditionCollection;
use App\Http\Resources\AggregatedByVaccinationConditionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByVaccinationConditionController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationConditionCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_vaccination_conditions"), $request);
        return new AggregatedByVaccinationConditionCollection(
            AggregatedByVaccinationConditionResource::make($data)
        );
    }
}
