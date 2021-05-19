<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/test', function () {
    \App\Jobs\DownloadCSVJob::dispatchSync("https://sisa.msal.gov.ar/datos/descargas/covid-19/files/datos_nomivac_covid19.zip", "VaccineRegistry.zip");
    \App\Jobs\InsertAggregateDataByResidenceProvinceAndGenderJob::dispatch();
    \App\Jobs\InsertAggregateDataByVaccinationProvinceAndAgeRangeJob::dispatch();
    \App\Jobs\InsertAggregateDataByVaccinationProvinceAndGenderJob::dispatch();
    \App\Jobs\InsertAggregatedByResidenceProvinceAndAgeRangeJob::dispatch();
    \App\Jobs\InsertAggregatedByResidenceProvinceAndVaccinationCondition::dispatch();
    \App\Jobs\InsertAggregatedByResidenceProvinceAndVaccinationDate::dispatch();
    \App\Jobs\InsertAggregatedByResidenceProvinceAndVaccine::dispatch();
    \App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccinationCondition::dispatch();
    \App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccinationDate::dispatch();
    \App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccine::dispatch();
    //\App\Jobs\DownloadCSVJob::dispatch("https://sisa.msal.gov.ar/datos/descargas/covid-19/files/Covid19VacunasAgrupadas.csv.zip", "Locations.zip");
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
