<?php

namespace App\Jobs;

use App\Models\AggregatedByResidenceProvinceAndVaccine;
use App\Models\AggregatedByVaccinationProvinceAndVaccine;
use App\Models\Province;
use App\Models\VaccineQuantity;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class CacheVaccineQuantityJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        $provinces = Province::all();
        $provinces->each(function($province){
            Cache::forget("vaccines_quantity_in_$province->name");
            Cache::rememberForever("vaccines_quantity_in_$province->name", function() use ($province){
                return VaccineRegistry::where("province_of_residence", $province->name)->count()
                    + VaccineRegistry::where("vaccinated_in_the_province", $province->name)->count();
            });
        });
        Cache::forget("vaccines_quantity_in_Nacion");
        Cache::rememberForever("vaccines_quantity_in_Nacion", function(){
            return VaccineRegistry::count();
        });
    }
}
