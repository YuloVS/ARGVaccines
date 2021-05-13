<?php

namespace App\Jobs;

use App\Imports\QtyByLocationsImport;
use App\Models\QtyByLocation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportCSVJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $csvPath;
    private QtyByLocationsImport $qtyByLocationsImport;

    public function __construct()
    {
        $this->csvPath = storage_path("app/vaccines/Covid19VacunasAgrupadas.csv");
        $this->qtyByLocationsImport = new QtyByLocationsImport();
    }

    public function handle()
    {
        QtyByLocation::truncate();
        Excel::import($this->qtyByLocationsImport, $this->csvPath);
    }
}
