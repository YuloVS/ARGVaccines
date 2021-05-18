<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByResidenceProvinceAndGenderCollection;
use App\Http\Resources\AggregatedByResidenceProvinceAndGenderResource;
use App\Models\AggregatedByResidenceProvinceAndGender;
use Illuminate\Http\Request;

class AggregatedByResidenceProvinceAndGenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    : AggregatedByResidenceProvinceAndGenderCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByResidenceProvinceAndGender::query(), $request);
        return new AggregatedByResidenceProvinceAndGenderCollection(
            AggregatedByResidenceProvinceAndGenderResource::make($query->get())
        );
    }
}
