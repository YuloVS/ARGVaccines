<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndGenderCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndGenderResource;
use App\Models\AggregatedByResidenceProvinceAndGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByResidenceProvinceAndGenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndGenderCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_residence_province_and_genders"), $request);
        return new AggregatedByResidenceProvinceAndGenderCollection(
            AggregatedByResidenceProvinceAndGenderResource::make($data)
        );
    }
}
