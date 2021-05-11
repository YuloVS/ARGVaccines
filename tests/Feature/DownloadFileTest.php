<?php

namespace Tests\Feature;

use App\Jobs\DownloadCSVJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class DownloadFileTest extends TestCase
{
    public function test_file_is_downloaded()
    {
        $filesDirectory = storage_path("App\Vaccines");
        if(file_exists($filesDirectory))
        {
            File::deleteDirectory($filesDirectory);
        }
        DownloadCSVJob::dispatchSync("https://sisa.msal.gov.ar/datos/descargas/covid-19/files/Covid19VacunasAgrupadas.csv.zip");
        $this->assertTrue(file_exists(storage_path("App\Vaccines\Locations.csv")));
    }
}
