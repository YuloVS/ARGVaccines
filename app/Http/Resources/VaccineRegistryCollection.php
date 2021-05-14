<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VaccineRegistryCollection extends ResourceCollection
{
    public function toArray($request)
    : array
    {
        return [
            "data" => $this->collection,
            "total_records" => $this->collection->count(),
            "source" => "https://sisa.msal.gov.ar/datos/descargas/covid-19/files/datos_nomivac_covid19.zip"
        ];
    }
}
