<?php

namespace App\Jobs;

use App\Imports\QtyByLocationsImport;
use App\Imports\VaccineRegistryImport;
use App\Models\QtyByLocation;
use App\Models\VaccineRegistry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
use League\Csv\Statement;
use Maatwebsite\Excel\Facades\Excel;

class ImportCSVJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $csvName;
    private string $csvPath;

    public function __construct(string $csvName)
    {
        $this->csvName = $csvName;
        $this->csvPath = storage_path("app/vaccines/$csvName");
    }

    public function handle()
    {
        Log::info("Init Import JOB");
        if($this->csvName == "Covid19VacunasAgrupadas.csv")
        {
            Log::info("Import By Locations");
            QtyByLocation::truncate();
            $qtyByLocationsImport = new QtyByLocationsImport();
            Excel::import($qtyByLocationsImport, $this->csvPath);
        }
        elseif($this->csvName == "datos_nomivac_covid19.csv")
        {
            Log::info("Import Vaccines Registry");
            VaccineRegistry::truncate();
            $stream = fopen(storage_path("app/vaccines/datos_nomivac_covid19.csv"), "r");
            $csv = Reader::createFromStream($stream);
            $stmt = Statement::create()->offset(1);
            $records = $stmt->process($csv);
            $vaccineRegistries = [];
            foreach ($records as $record) {
                $vaccineRegistry = [
                    "gender" => $record[0],
                    "age_range" => $record[1],
                    "province_of_residence" => $record[2],
                    "city_of_residence" => $record[4],
                    "vaccinated_in_the_province" => $record[6],
                    "vaccinated_in_the_city" => $record[8],
                    "vaccination_date" => $record[10],
                    "vaccine" => $record[11],
                    "vaccination_condition" => $record[12]
                ];
                array_push($vaccineRegistries, $vaccineRegistry);
                if(count($vaccineRegistries) == 1000)
                {
                    VaccineRegistry::insert($vaccineRegistries);
                    $vaccineRegistries = [];
                }
            }
            if(!empty($vaccineRegistries))
            {
                VaccineRegistry::insert($vaccineRegistries);
            }
        }
        else
        {
            Log::critical("Undefined CSV");
        }
        Log::info("End Import JOB");
    }
}
