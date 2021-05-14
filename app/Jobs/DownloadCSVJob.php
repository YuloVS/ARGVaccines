<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DownloadCSVJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $downloadLink;
    private string $filesDirectory;
        private string $fileName;
    private string $filePath;

    public function __construct(string $downloadLink, string $fileName)
    {
        $this->downloadLink = $downloadLink;
        $this->filesDirectory = storage_path("app/vaccines");
        $this->fileName = $fileName;
        $this->filePath = "vaccines/$fileName";
    }

    public function handle()
    {
        Log::info("Init Download JOB");
        if(!file_exists($this->filesDirectory))
        {
            File::makeDirectory($this->filesDirectory, 0777, true);
        }
        $file = Http::get($this->downloadLink)->body();
        Storage::put($this->filePath, $file);
        Log::info("End Download JOB");
        ExtractZipJob::dispatchSync($this->fileName);
    }
}
