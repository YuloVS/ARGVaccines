<?php

namespace App\Console\Commands;

use App\Jobs\DownloadCSVJob;
use App\Jobs\ImportCSVJob;
use App\Jobs\InsertAggregateDataByResidenceProvinceAndGenderJob;
use App\Jobs\InsertAggregateDataByVaccinationProvinceAndAgeRangeJob;
use App\Jobs\InsertAggregateDataByVaccinationProvinceAndGenderJob;
use App\Jobs\InsertAggregatedByAgeRangeJob;
use App\Jobs\InsertAggregatedByGenderJob;
use App\Jobs\InsertAggregatedByResidenceProvinceAndAgeRangeJob;
use App\Jobs\InsertAggregatedByResidenceProvinceAndVaccinationCondition;
use App\Jobs\InsertAggregatedByResidenceProvinceAndVaccinationDate;
use App\Jobs\InsertAggregatedByResidenceProvinceAndVaccine;
use App\Jobs\InsertAggregatedByVaccinationConditionJob;
use App\Jobs\InsertAggregatedByVaccinationDateJob;
use App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccinationCondition;
use App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccinationDate;
use App\Jobs\InsertAggregatedByVaccinationProvinceAndVaccine;
use App\Jobs\InsertAggregatedDataByVaccineJob;
use App\Jobs\InsertVaccineQuantityJob;
use Illuminate\Console\Command;

class UpdateData extends Command
{
    protected $signature = 'update:data {--d|download} {--i|import} {--O|only}';

    protected $description = 'Download the CSV and update all the vaccine related tables.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $bar = $this->output->createProgressBar($this->option("download") ? 17 : 18); // TODO SET PROPER STEPS
        $bar->start();
        if($this->option("download"))
        {
            $this->warn("Downloading CSV");
            DownloadCSVJob::dispatchSync("https://sisa.msal.gov.ar/datos/descargas/covid-19/files/datos_nomivac_covid19.zip", "VaccineRegistry.zip");
            if($this->option("only")) return;
        }
        if($this->option("import"))
        {
            $this->warn("Importing vaccines data");
            ImportCSVJob::dispatchSync("datos_nomivac_covid19.csv");
        }
        $bar->advance();
        $this->warn("Dispatching insert jobs.");
        InsertAggregateDataByResidenceProvinceAndGenderJob::dispatchSync();
        $bar->advance();
        InsertAggregateDataByVaccinationProvinceAndAgeRangeJob::dispatchSync();
        $bar->advance();
        InsertAggregateDataByVaccinationProvinceAndGenderJob::dispatchSync();
        $bar->advance();
        InsertAggregatedByResidenceProvinceAndAgeRangeJob::dispatchSync();
        $bar->advance();
        InsertAggregatedByResidenceProvinceAndVaccinationCondition::dispatchSync();
        $bar->advance();
        InsertAggregatedByResidenceProvinceAndVaccinationDate::dispatchSync();
        $bar->advance();
        InsertAggregatedByResidenceProvinceAndVaccine::dispatchSync();
        $bar->advance();
        InsertAggregatedByVaccinationProvinceAndVaccinationCondition::dispatchSync();
        $bar->advance();
        InsertAggregatedByVaccinationProvinceAndVaccinationDate::dispatchSync();
        $bar->advance();
        InsertAggregatedByVaccinationProvinceAndVaccine::dispatchSync();
        $bar->advance();
        InsertAggregatedByResidenceProvinceAndVaccine::dispatchSync();
        $bar->advance();
        InsertAggregatedDataByVaccineJob::dispatchSync();
        $bar->advance();
        InsertAggregatedByAgeRangeJob::dispatchSync();
        $bar->advance();
        InsertAggregatedByGenderJob::dispatchSync();
        $bar->advance();
        InsertAggregatedByVaccinationConditionJob::dispatchSync();
        $bar->advance();
        InsertAggregatedByVaccinationDateJob::dispatchSync();
        $bar->advance();
        InsertVaccineQuantityJob::dispatchSync();
        $bar->advance();
        $this->info("Done.");
        $bar->finish();
    }
}
