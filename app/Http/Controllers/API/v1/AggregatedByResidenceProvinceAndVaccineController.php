<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccineCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccineResource;
use App\Models\AggregatedByResidenceProvinceAndVaccine;
use Illuminate\Http\Request;

class AggregatedByResidenceProvinceAndVaccineController extends Controller
{
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndVaccineCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByResidenceProvinceAndVaccine::query(), $request);
        return new  AggregatedByResidenceProvinceAndVaccineCollection(
            AggregatedByResidenceProvinceAndVaccineResource::make($query->get())
        );
    }
}
