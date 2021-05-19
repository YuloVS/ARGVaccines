<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccinationConditionCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccinationConditionResource;
use App\Models\AggregatedByVaccinationProvinceAndVaccinationCondition;
use Illuminate\Http\Request;

class AggregatedByVaccinationProvinceAndVaccinationConditionController extends Controller
{
    public function index(Request $request)
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByVaccinationProvinceAndVaccinationCondition::query(), $request);
        return new AggregatedByVaccinationProvinceAndVaccinationConditionCollection(
            AggregatedByVaccinationProvinceAndVaccinationConditionResource::make($query->get())
        );
    }
}
