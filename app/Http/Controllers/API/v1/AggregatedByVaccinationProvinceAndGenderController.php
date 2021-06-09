<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationProvinceAndGenderCollection;
use App\Http\Resources\AggregatedByVaccinationProvinceAndGenderResource;
use App\Models\AggregatedByVaccinationProvinceAndGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByVaccinationProvinceAndGenderController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationProvinceAndGenderCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_vaccination_province_and_genders"), $request);
        return new AggregatedByVaccinationProvinceAndGenderCollection(
            AggregatedByVaccinationProvinceAndGenderResource::make($data)
        );
    }
}
