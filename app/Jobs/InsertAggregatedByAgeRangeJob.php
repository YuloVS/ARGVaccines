<?php

namespace App\Jobs;

use App\Models\AggregatedByAgeRange;
use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByAgeRangeJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByAgeRange::truncate();
        $records = VaccineRegistry::select("age_range", DB::raw('count(*) as quantity'))
            ->groupBy("age_range")
            ->get()->toArray();
        AggregatedByAgeRange::insert($records);
        Log::info("End ". self::class);
    }
}
