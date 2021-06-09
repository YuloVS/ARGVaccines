<?php

namespace App\Jobs;

use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheAggregatedByAgeRangeJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        Cache::forget("aggregated_by_age_ranges");
        Cache::rememberForever("aggregated_by_age_ranges", function(){
            return VaccineRegistry::select("age_range", DB::raw('count(*) as quantity'))
                ->groupBy("age_range")
                ->get();
        });
    }
}
