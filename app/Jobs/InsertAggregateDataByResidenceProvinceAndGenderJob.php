<?php

namespace App\Jobs;

use App\Models\AggregatedByResidenceProvinceAndGender;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class InsertAggregateDataByResidenceProvinceAndGenderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        AggregatedByResidenceProvinceAndGender::truncate();
        $genders = VaccineRegistry::select("province_of_residence", "gender", DB::raw('count(*) as quantity'))
            ->groupBy("province_of_residence", "gender")
            ->get()->toArray();
        AggregatedByResidenceProvinceAndGender::insert($genders);
    }
}
