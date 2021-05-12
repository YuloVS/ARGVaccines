<?php

use App\Http\Resources\QtyByLocationCollection;
use App\Http\Resources\TotalDosesResource;
use App\Models\QtyByLocation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/qty-by-locations', function () {
    return new QtyByLocationCollection(QtyByLocation::all());
});

Route::get("/qty-by-location/{location}", function($location){
    $location = str_replace("_", " ", $location);
    return new QtyByLocationCollection(QtyByLocation::whereProvince($location)->get());
});

Route::get('/total-doses', function(){
    return new TotalDosesResource(QtyByLocation::totalDoses());
});

Route::get('/total-first-doses', function(){
    return new TotalDosesResource(QtyByLocation::totalFirstDoses());
});

Route::get('/total-second-doses', function(){
    return new TotalDosesResource(QtyByLocation::totalSecondDoses());
});