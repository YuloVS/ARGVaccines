<?php

namespace App\Jobs;

use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheAggregatedByResidenceProvinceAndVaccinationConditionJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        Cache::forget("aggregated_by_residence_province_and_vaccination_conditions");
        Cache::rememberForever("aggregated_by_residence_province_and_vaccination_conditions", function(){
            return VaccineRegistry::select("province_of_residence", "vaccination_condition", DB::raw('count(*) as quantity'))
                ->groupBy("province_of_residence", "vaccination_condition")
                ->get();
        });
    }
}
