<?php

namespace App\Jobs;

use App\Models\AggregatedByResidenceProvinceAndVaccine;
use App\Models\AggregatedByVaccinationProvinceAndVaccine;
use App\Models\VaccineQuantity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertVaccineQuantityJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue;

    public function handle()
    {
        VaccineQuantity::truncate();
        AggregatedByVaccinationProvinceAndVaccine::groupBy("vaccinated_in_the_province")
            ->selectRaw('vaccinated_in_the_province, sum(quantity) as quantity')
        ->each(function($record){
            VaccineQuantity::create([
                "vaccinated_in" => true,
                "province" => $record->vaccinated_in_the_province,
                "quantity" => $record->quantity
                                    ]);
        });
        AggregatedByResidenceProvinceAndVaccine::groupBy("province_of_residence")
            ->selectRaw('province_of_residence, sum(quantity) as quantity')
            ->each(function($record){
                VaccineQuantity::create([
                                            "vaccinated_in" => false,
                                            "province" => $record->province_of_residence,
                                            "quantity" => $record->quantity
                                        ]);
            });
        VaccineQuantity::create([
            "vaccinated_in" => true,
            "province" => "Nacion",
            "quantity" => VaccineQuantity::where("vaccinated_in", true)->sum("quantity")
                                ]);
    }
}
