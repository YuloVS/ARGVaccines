<?php

namespace App\Imports;

use App\Models\QtyByLocation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QtyByLocationsImport implements ToModel
{
    public function model(array $row)
    : ?QtyByLocation
    {
        if($row[0] == "jurisdiccion_codigo_indec")
        {
            return null;
        }
        return new QtyByLocation([
            "province" => $row[1],
            "vaccine" => $row[2],
            "first_dose" => $row[3],
            "second_dose" => $row[4]
        ]);
    }
}
