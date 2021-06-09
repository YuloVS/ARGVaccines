<?php

namespace App\Jobs;

use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheAggregatedByResidenceProvinceAndGenderJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;

    public function handle()
    {
        Cache::forget("aggregated_by_residence_province_and_genders");
        Cache::rememberForever("aggregated_by_residence_province_and_genders", function(){
            return VaccineRegistry::select("province_of_residence", "gender", DB::raw('count(*) as quantity'))
                ->groupBy("province_of_residence", "gender")
                ->get();
        });
    }
}
