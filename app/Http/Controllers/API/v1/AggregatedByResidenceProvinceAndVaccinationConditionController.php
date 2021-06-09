<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccinationConditionCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccinationConditionResource;
use App\Models\AggregatedByResidenceProvinceAndVaccinationCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByResidenceProvinceAndVaccinationConditionController extends Controller
{
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndVaccinationConditionCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_residence_province_and_vaccination_conditions"), $request);
        return new AggregatedByResidenceProvinceAndVaccinationConditionCollection(
            AggregatedByResidenceProvinceAndVaccinationConditionResource::make($data)
        );
    }
}
