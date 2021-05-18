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

class InsertAggregatedByResidenceProvinceAndVaccinationDate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        AggregatedByResidenceProvinceAndVaccinationDate::truncate();
        $records = VaccineRegistry::select("province_of_residence", "vaccination_date", DB::raw('count(*) as quantity'))
            ->groupBy("vaccinated_in_the_province", "vaccination_date")
            ->get()->toArray();
        AggregatedByResidenceProvinceAndVaccinationDate::insert($records);
    }
}
