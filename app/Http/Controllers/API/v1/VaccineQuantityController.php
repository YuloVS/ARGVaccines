<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\VaccineQuantityCollection;
use App\Http\Resources\VaccineQuantityResource;
use App\Models\VaccineQuantity;
use Illuminate\Http\Request;

class VaccineQuantityController extends Controller
{
    public function index(Request $request)
    : VaccineQuantityCollection
    {
        $query = RequestQueryBuilder::buildQuery(VaccineQuantity::query(), $request);
        return new VaccineQuantityCollection(
            VaccineQuantityResource::make($query->get())
        );
    }
}
