<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccinationDateCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccinationDateResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByVaccinationProvinceAndVaccinationDateController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationProvinceAndVaccinationDateCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_vaccination_province_and_vaccination_dates"), $request);
        return new AggregatedByVaccinationProvinceAndVaccinationDateCollection(
            AggregatedByVaccinationProvinceAndVaccinationDateResource::make($data)
        );
    }
}
