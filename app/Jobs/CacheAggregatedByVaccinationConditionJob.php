<?php

namespace App\Jobs;

use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheAggregatedByVaccinationConditionJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        Cache::forget("aggregated_by_vaccination_conditions");
        Cache::rememberForever("aggregated_by_vaccination_conditions", function(){
            return VaccineRegistry::select("vaccination_condition", DB::raw('count(*) as quantity'))
                ->groupBy("vaccination_condition")
                ->get();
        });
    }
}
