<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccinationConditionCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccinationConditionResource;
use App\Models\AggregatedByVaccinationProvinceAndVaccinationCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByVaccinationProvinceAndVaccinationConditionController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationProvinceAndVaccinationConditionCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_vaccination_province_and_vaccination_conditions"), $request);
        return new AggregatedByVaccinationProvinceAndVaccinationConditionCollection(
            AggregatedByVaccinationProvinceAndVaccinationConditionResource::make($data)
        );
    }
}
