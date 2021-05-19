<?php

namespace App\Jobs;

use App\Models\AggregatedByVaccine;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedDataByVaccineJob implements ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByVaccine::truncate();
        $records = VaccineRegistry::select("vaccine", DB::raw('count(*) as quantity'))
            ->groupBy("vaccine")
            ->get()->toArray();
        AggregatedByVaccine::insert($records);
        Log::info("End ". self::class);
    }
}
