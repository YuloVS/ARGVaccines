<?php

namespace App\Jobs;

use App\Models\AggregatedByVaccinationDate;
use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByVaccinationDateJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByVaccinationDate::truncate();
        $records = VaccineRegistry::select("vaccination_date", DB::raw('count(*) as quantity'))
            ->groupBy("vaccination_date")
            ->get()->toArray();
        AggregatedByVaccinationDate::insert($records);
        Log::info("End ". self::class);
    }
}
