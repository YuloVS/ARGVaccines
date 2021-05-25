<?php

namespace App\Jobs;

use App\Models\AggregatedByVaccinationCondition;
use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByVaccinationConditionJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByVaccinationCondition::truncate();
        $records = VaccineRegistry::select("vaccination_condition", DB::raw('count(*) as quantity'))
            ->groupBy("vaccination_condition")
            ->get()->toArray();
        AggregatedByVaccinationCondition::insert($records);
        Log::info("End ". self::class);
    }
}
