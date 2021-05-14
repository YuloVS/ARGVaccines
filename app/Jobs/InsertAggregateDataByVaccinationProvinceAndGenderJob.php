<?php

namespace App\Jobs;

use App\Models\AggregatedByVaccinationProvinceAndGender;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class InsertAggregateDataByVaccinationProvinceAndGenderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        AggregatedByVaccinationProvinceAndGender::truncate();
        $records = VaccineRegistry::select("vaccinated_in_the_province", "gender", DB::raw('count(*) as quantity'))
            ->groupBy("vaccinated_in_the_province", "gender")
            ->get()->toArray();
        AggregatedByVaccinationProvinceAndGender::insert($records);
    }
}
