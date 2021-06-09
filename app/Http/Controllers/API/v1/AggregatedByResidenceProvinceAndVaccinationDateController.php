<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccinationDateCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndVaccinationDateResource;
use App\Models\AggregatedByResidenceProvinceAndVaccinationDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByResidenceProvinceAndVaccinationDateController extends Controller
{
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndVaccinationDateCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_residence_province_and_vaccination_dates"), $request);
        return new AggregatedByResidenceProvinceAndVaccinationDateCollection(
            AggregatedByResidenceProvinceAndVaccinationDateResource::make($data)
        );
    }
}
