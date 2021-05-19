<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccinationDateCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccinationDateResource;
use App\Models\AggregatedByResidenceProvinceAndVaccinationDate;
use Illuminate\Http\Request;

class AggregatedByResidenceProvinceAndVaccinationDateController extends Controller
{
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndVaccinationDateCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByResidenceProvinceAndVaccinationDate::query(), $request);
        return new AggregatedByResidenceProvinceAndVaccinationDateCollection(
            AggregatedByResidenceProvinceAndVaccinationDateResource::make($query->get())
        );
    }
}
