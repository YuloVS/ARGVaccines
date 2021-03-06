<?php

namespace App\Jobs;

use App\Models\AggregatedByVaccinationProvinceAndVaccine;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByVaccinationProvinceAndVaccine implements ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByVaccinationProvinceAndVaccine::truncate();
        $records = VaccineRegistry::select("vaccinated_in_the_province", "vaccine", DB::raw('count(*) as quantity'))
            ->groupBy("vaccinated_in_the_province", "vaccine")
            ->get()->toArray();
        AggregatedByVaccinationProvinceAndVaccine::insert($records);
        Log::info("End ". self::class);
    }
}
