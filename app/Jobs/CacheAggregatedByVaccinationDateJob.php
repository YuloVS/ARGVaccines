<?php

namespace App\Jobs;

use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheAggregatedByVaccinationDateJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        Cache::forget("aggregated_by_vaccination_dates");
        Cache::rememberForever("aggregated_by_vaccination_dates", function(){
            return VaccineRegistry::select("vaccination_date", DB::raw('count(*) as quantity'))
                ->groupBy("vaccination_date")
                ->get();
        });
    }
}
