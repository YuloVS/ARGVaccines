<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationDateCollection;
use App\Http\Resources\AggregatedByVaccinationDateResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByVaccinationDateController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationDateCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_vaccination_dates"), $request);
        return new AggregatedByVaccinationDateCollection(
            AggregatedByVaccinationDateResource::make($data)
        );
    }
}
