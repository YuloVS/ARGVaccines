<?php

namespace App\Console\Commands;

use App\Helpers\CacheJobsDispatcher;
use Illuminate\Console\Command;

class CacheJobs extends Command
{
    protected $signature = 'cache:jobs';

    protected $description = 'Run all query caching jobs.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info("There are " . CacheJobsDispatcher::quantity() . " caching jobs.");
        $this->info("Dispatching...");
        CacheJobsDispatcher::dispatch();
        $this->info("Done.");
    }
}
