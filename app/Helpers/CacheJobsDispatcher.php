<?php


namespace App\Helpers;

const JOBS_DIR = "App\Jobs\\";

class CacheJobsDispatcher
{
    public static function dispatch()
    {
        $files = scandir(JOBS_DIR);
        foreach($files as $file)
        {
            if(substr($file, 0, 5) == "Cache")
            {
                $job = JOBS_DIR.substr($file, 0, -4);
                $job::dispatchSync();

            }
        }
    }

    public static function quantity()
    : int
    {
        $quantity = 0;
        $files = scandir(JOBS_DIR);
        foreach($files as $file)
        {
            if(substr($file, 0, 5) == "Cache")
            {
                $quantity++;

            }
        }
        return $quantity;
    }

}