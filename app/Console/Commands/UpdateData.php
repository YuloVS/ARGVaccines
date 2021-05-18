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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download the CSV and update all the vaccine related tables.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DownloadCSVJob::dispatchSync("https://sisa.msal.gov.ar/datos/descargas/covid-19/files/datos_nomivac_covid19.zip", "VaccineRegistry.zip");
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
