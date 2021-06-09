<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\AggregatedByGenderCollection;
use App\Http\Resources\AggregatedByGenderResource;
use App\Models\AggregatedByGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AggregatedByGenderController extends Controller
{
    public function index(Request $request)
    : AggregatedByGenderCollection
    {
        $data = RequestQueryBuilder::buildCollection(Cache::get("aggregated_by_genders"), $request);
        return new AggregatedByGenderCollection(
            AggregatedByGenderResource::make($data)
        );
    }
}
