<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationConditionCollection;
use App\Http\Resources\AggregatedByVaccinationConditionResource;
use App\Models\AggregatedByVaccinationCondition;
use Illuminate\Http\Request;

class AggregatedByVaccinationConditionController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationConditionCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByVaccinationCondition::query(), $request);
        return new AggregatedByVaccinationConditionCollection(
            AggregatedByVaccinationConditionResource::make($query->get())
        );
    }
}
