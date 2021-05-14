<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Macellan\Zip\Zip;

class ExtractZipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $filesDirectory;
    private string $filePath;

    public function __construct(string $zipFileName)
    {
        $this->filesDirectory = storage_path("app/vaccines");
        $this->filePath = "$this->filesDirectory/$zipFileName";
    }

    public function handle()
    {
        Log::info("Init Extract JOB");
        try
        {
            $zip = Zip::open($this->filePath);
            $zip->extract($this->filesDirectory);
            Log::info("End Extract JOB");
            ImportCSVJob::dispatchSync($zip->listFiles()[0]);
        }
        catch(\Exception $e)
        {
            //TODO HANDLE EXCEPTION
        }
    }
}
