<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccineCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccineResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByVaccinationProvinceAndVaccineController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationProvinceAndVaccineCollection
    {
        $collection = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_vaccination_province_and_vaccines"), $request);
        return new AggregatedByVaccinationProvinceAndVaccineCollection(
            AggregatedByVaccinationProvinceAndVaccineResource::make($collection)
        );
    }
}
