<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByVaccinationDateCollection;
use App\Http\Resources\AggregatedByVaccinationDateResource;
use App\Models\AggregatedByVaccinationDate;
use Illuminate\Http\Request;

class AggregatedByVaccinationDateController extends Controller
{
    public function index(Request $request)
    : AggregatedByVaccinationDateCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByVaccinationDate::query(), $request);
        return new AggregatedByVaccinationDateCollection(
            AggregatedByVaccinationDateResource::make($query->get())
        );
    }
}
