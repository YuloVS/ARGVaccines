<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccineCollection;
use App\Http\Resources\AggregatedByVaccineResource;
use App\Models\AggregatedByVaccine;
use Illuminate\Http\Request;

class AggregatedByVaccineController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccineCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByVaccine::query(), $request);
        return new AggregatedByVaccineCollection(
            AggregatedByVaccineResource::make($query->get())
        );
    }
}
