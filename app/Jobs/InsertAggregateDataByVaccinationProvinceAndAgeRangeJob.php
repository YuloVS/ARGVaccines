<?php

namespace App\Jobs;

use App\Models\AggregatedByVaccinationProvinceAndAgeRange;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class InsertAggregateDataByVaccinationProvinceAndAgeRangeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        AggregatedByVaccinationProvinceAndAgeRange::truncate();
        $records = VaccineRegistry::select("vaccinated_in_the_province", "age_range", DB::raw('count(*) as quantity'))
            ->groupBy("vaccinated_in_the_province", "age_range")
            ->get()->toArray();
        AggregatedByVaccinationProvinceAndAgeRange::insert($records);
    }
}
