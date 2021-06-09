<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccineCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccineResource;
use App\Models\AggregatedByResidenceProvinceAndVaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByResidenceProvinceAndVaccineController extends Controller
{
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndVaccineCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_residence_province_and_vaccines"), $request);
        return new  AggregatedByResidenceProvinceAndVaccineCollection(
            AggregatedByResidenceProvinceAndVaccineResource::make($data)
        );
    }
}
