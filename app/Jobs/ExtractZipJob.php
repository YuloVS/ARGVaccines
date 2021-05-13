<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Macellan\Zip\Zip;

class ExtractZipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $filesDirectory;
    private string $filePath;

    public function __construct()
    {
        $this->filesDirectory = storage_path("app/vaccines");
        $this->filePath = "{$this->filesDirectory}/Locations.zip";
    }

    public function handle()
    {
        try
        {
            Zip::open($this->filePath)->extract($this->filesDirectory);
            ImportCSVJob::dispatch();
        }
        catch(\Exception $e)
        {
            //TODO HANDLE EXCEPTION
        }
    }
}
