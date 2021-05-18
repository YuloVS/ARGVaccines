<?php

namespace App\Jobs;

use App\Models\AggregatedByResidenceProvinceAndVaccinationDate;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByResidenceProvinceAndVaccinationDate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByResidenceProvinceAndVaccinationDate::truncate();
        $records = VaccineRegistry::select("province_of_residence", "vaccination_date", DB::raw('count(*) as quantity'))
            ->groupBy("province_of_residence", "vaccination_date")
            ->get()->toArray();
        AggregatedByResidenceProvinceAndVaccinationDate::insert($records);
        Log::info("End ". self::class);
    }
}
