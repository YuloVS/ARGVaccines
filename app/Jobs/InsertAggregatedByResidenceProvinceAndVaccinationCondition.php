<?php

namespace App\Jobs;

use App\Models\AggregatedByResidenceProvinceAndVaccinationCondition;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class InsertAggregatedByResidenceProvinceAndVaccinationCondition implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        AggregatedByResidenceProvinceAndVaccinationCondition::truncate();
        $records = VaccineRegistry::select("province_of_residence", "vaccination_condition", DB::raw('count(*) as quantity'))
            ->groupBy("province_of_residence", "vaccination_condition")
            ->get()->toArray();
        AggregatedByResidenceProvinceAndVaccinationCondition::insert($records);
    }
}
