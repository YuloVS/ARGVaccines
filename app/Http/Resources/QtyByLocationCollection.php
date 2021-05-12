<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class QtyByLocationCollection extends ResourceCollection
{
    #[ArrayShape(["data" => "\Illuminate\Support\Collection", "total_records" => "int", "total_first_dose" => "mixed", "total_second_dose" => "mixed", "source" => "string"])]
    public function toArray($request)
    : array
    {
        return [
            "data" => $this->collection,
            "total_records" => $this->collection->count(),
            "total_first_dose" => $this->collection->sum("first_dose"),
            "total_second_dose" => $this->collection->sum("second_dose"),
            "source" => "https://sisa.msal.gov.ar/datos/descargas/covid-19/files/Covid19VacunasAgrupadas.csv.zip"
        ];
    }
}
