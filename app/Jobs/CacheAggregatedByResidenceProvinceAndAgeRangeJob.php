<?php

namespace App\Jobs;

use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheAggregatedByResidenceProvinceAndAgeRangeJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        Cache::forget("aggregated_by_residence_province_and_age_ranges");
        Cache::rememberForever("aggregated_by_residence_province_and_age_ranges", function(){
            return VaccineRegistry::select("province_of_residence", "age_range", DB::raw('count(*) as quantity'))
                ->groupBy("vaccinated_in_the_province", "age_range")
                ->get();
        });
    }
}
