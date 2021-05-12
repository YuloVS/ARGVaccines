<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use JetBrains\PhpStorm\ArrayShape;

class QtyByLocationCollection extends ResourceCollection
{
    #[ArrayShape(["data" => "\Illuminate\Support\Collection", "source" => "string"])] public function toArray($request)
    : array
    {
        return [
            "data" => $this->collection,
            "source" => "https://sisa.msal.gov.ar/datos/descargas/covid-19/files/Covid19VacunasAgrupadas.csv.zip"
        ];
    }
}
