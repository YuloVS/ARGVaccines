<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccinationDateCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndVaccinationDateResource;
use App\Models\AggregatedByVaccinationProvinceAndVaccinationDate;
use Illuminate\Http\Request;

class AggregatedByVaccinationProvinceAndVaccinationDateController extends Controller
{
    public function index(Request $request)
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByVaccinationProvinceAndVaccinationDate::query(), $request);
        return new AggregatedByVaccinationProvinceAndVaccinationDateCollection(
            AggregatedByVaccinationProvinceAndVaccinationDateResource::make($query->get())
        );
    }
}
