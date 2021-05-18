<?php

namespace App\Jobs;

use App\Models\AggregatedByResidenceProvinceAndVaccine;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByResidenceProvinceAndVaccine implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByResidenceProvinceAndVaccine::truncate();
        $records = VaccineRegistry::select("province_of_residence", "vaccine", DB::raw('count(*) as quantity'))
            ->groupBy("province_of_residence", "vaccine")
            ->get()->toArray();
        AggregatedByResidenceProvinceAndVaccine::insert($records);
        Log::info("End ". self::class);
    }
}
