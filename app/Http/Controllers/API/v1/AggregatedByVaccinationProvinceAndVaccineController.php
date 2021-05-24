<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccineCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccineResource;
use App\Models\AggregatedByVaccinationProvinceAndVaccine;
use Illuminate\Http\Request;

class AggregatedByVaccinationProvinceAndVaccineController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationProvinceAndVaccineCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByVaccinationProvinceAndVaccine::query(), $request);
        return new AggregatedByVaccinationProvinceAndVaccineCollection(
            AggregatedByVaccinationProvinceAndVaccineResource::make($query->get())
        );
    }
}
