<?php

namespace App\Console\Commands;

use App\Jobs\DownloadCSVJob;
use App\Jobs\InsertAggregateDataByResidenceProvinceAndGenderJob;
use App\Jobs\InsertAggregateDataByVaccinationProvinceAndAgeRangeJob;
use App\Jobs\InsertAggregateDataByVaccinationProvinceAndGenderJob;
use App\Jobs\InsertAggregatedByResidenceProvinceAndAgeRangeJob;
use App\Jobs\InsertAggregatedByResidenceProvinceAndVaccinationCondition;
use App\Jobs\InsertAggregatedByResidenceProvinceAndVaccinationDate;
use App\Jobs\InsertAggregatedByResidenceProvinceAndVaccine;
use App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccinationCondition;
use App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccinationDate;
use App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccine;
use Illuminate\Console\Command;

class UpdateData extends Command
{
    protected $signature = 'update:data {--d|download}';

    protected $description = 'Download the CSV and update all the vaccine related tables.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if($this->option("download"))
        {
            DownloadCSVJob::dispatchSync("https://sisa.msal.gov.ar/datos/descargas/covid-19/files/datos_nomivac_covid19.zip", "VaccineRegistry.zip");
        }
        InsertAggregateDataByResidenceProvinceAndGenderJob::dispatch();
        InsertAggregateDataByVaccinationProvinceAndAgeRangeJob::dispatch();
        InsertAggregateDataByVaccinationProvinceAndGenderJob::dispatch();
        InsertAggregatedByResidenceProvinceAndAgeRangeJob::dispatch();
        InsertAggregatedByResidenceProvinceAndVaccinationCondition::dispatch();
        InsertAggregatedByResidenceProvinceAndVaccinationDate::dispatch();
        InsertAggregatedByResidenceProvinceAndVaccine::dispatch();
        InsertAggregatedByVaccinationProvinceAndVaccinationCondition::dispatch();
        InsertAggregatedByVaccinationProvinceAndVaccinationDate::dispatch();
        InsertAggregatedByVaccinationProvinceAndVaccine::dispatch();
    }
}
