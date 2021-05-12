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
        $this->assertFileExists(storage_path("App\Vaccines\Locations.zip"));
    }

    public function test_zip_gets_extracted()
    {
        $this->test_file_is_downloaded();
        $this->assertFileExists(storage_path("App\Vaccines\Covid19VacunasAgrupadas.csv"));
    }
}
