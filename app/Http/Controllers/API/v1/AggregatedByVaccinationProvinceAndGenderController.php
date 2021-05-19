<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndGenderCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndGenderResource;
use App\Models\AggregatedByVaccinationProvinceAndGender;
use Illuminate\Http\Request;

class AggregatedByVaccinationProvinceAndGenderController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationProvinceAndGenderCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByVaccinationProvinceAndGender::query(), $request);
        return new AggregatedByVaccinationProvinceAndGenderCollection(
            AggregatedByVaccinationProvinceAndGenderResource::make($query->get())
        );
    }
}
