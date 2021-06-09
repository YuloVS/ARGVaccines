<?php

namespace App\Jobs;

use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheAggregatedByVaccinationProvinceAndVaccineJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        Cache::forget("aggregated_by_vaccination_province_and_vaccines");
        Cache::rememberForever("aggregated_by_vaccination_province_and_vaccines", function(){
            return VaccineRegistry::select("vaccinated_in_the_province", "vaccine", DB::raw('count(*) as quantity'))
                ->groupBy("vaccinated_in_the_province", "vaccine")
                ->get();
        });
    }
}
