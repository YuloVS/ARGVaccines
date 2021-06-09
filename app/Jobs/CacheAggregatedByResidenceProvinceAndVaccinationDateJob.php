<?php

namespace App\Jobs;

use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheAggregatedByResidenceProvinceAndVaccinationDateJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        Cache::forget("aggregated_by_residence_province_and_vaccination_dates");
        Cache::rememberForever("aggregated_by_residence_province_and_vaccination_dates", function(){
            return VaccineRegistry::select("province_of_residence", "vaccination_date", DB::raw('count(*) as quantity'))
                ->groupBy("province_of_residence", "vaccination_date")
                ->get();
        });
    }
}
