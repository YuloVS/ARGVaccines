<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\RequestQueryBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\VaccineQuantityCollection;
use App\Http\Resources\VaccineQuantityResource;
use App\Models\VaccineQuantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VaccineQuantityController extends Controller
{
    public function index(Request $request)
    : int
    {
        if($request->province) return Cache::get("vaccines_quantity_in_$request->province");
        return Cache::get("vaccines_quantity_in_Nacion");
    }
}
