<?php

namespace App\Jobs;

use App\Models\AggregatedByGender;
use App\Models\VaccineRegistry;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsertAggregatedByGenderJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue;

    public function handle()
    {
        Log::info("Init ". self::class);
        AggregatedByGender::truncate();
        $genders = VaccineRegistry::select("gender", DB::raw('count(*) as quantity'))
            ->groupBy("gender")
            ->get()->toArray();
        AggregatedByGender::insert($genders);
        Log::info("End ". self::class);
    }
}
