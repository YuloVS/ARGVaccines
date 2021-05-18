<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccinationConditionCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccinationConditionResource;
use App\Models\AggregatedByResidenceProvinceAndVaccinationCondition;
use Illuminate\Http\Request;

class AggregatedByResidenceProvinceAndVaccinationConditionController extends Controller
{
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndVaccinationConditionCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByResidenceProvinceAndVaccinationCondition::query(), $request);
        return new AggregatedByResidenceProvinceAndVaccinationConditionCollection(
            AggregatedByResidenceProvinceAndVaccinationConditionResource::make($query->get())
        );
    }
}
