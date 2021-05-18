<?php

namespace App\Jobs;

use App\Models\AggregatedByResidenceProvinceAndAgeRange;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByResidenceProvinceAndAgeRangeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByResidenceProvinceAndAgeRange::truncate();
        $records = VaccineRegistry::select("province_of_residence", "age_range", DB::raw('count(*) as quantity'))
            ->groupBy("vaccinated_in_the_province", "age_range")
            ->get()->toArray();
        AggregatedByResidenceProvinceAndAgeRange::insert($records);
        Log::info("End ". self::class);
    }
}
