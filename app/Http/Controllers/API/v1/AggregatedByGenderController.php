<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByGenderCollection;
use App\Http\Resources\AggregatedByGenderResource;
use App\Models\AggregatedByGender;
use Illuminate\Http\Request;

class AggregatedByGenderController extends Controller
{
    public function index(Request $request)
    : AggregatedByGenderCollection
    {
        $query = RequestQueryBuilder::buildQuery(AggregatedByGender::query(), $request);
        return new AggregatedByGenderCollection(
            AggregatedByGenderResource::make($query->get())
        );
    }
}
