<?php

namespace App\Jobs;

use App\Models\AggregatedByVaccinationProvinceAndVaccinationCondition;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByVaccinationProvinceAndVaccinationCondition implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByVaccinationProvinceAndVaccinationCondition::truncate();
        $records = VaccineRegistry::select("vaccinated_in_the_province", "vaccination_condition", DB::raw('count(*) as quantity'))
            ->groupBy("vaccinated_in_the_province", "vaccination_condition")
            ->get()->toArray();
        AggregatedByVaccinationProvinceAndVaccinationCondition::insert($records);
        Log::info("End ". self::class);
    }
}
