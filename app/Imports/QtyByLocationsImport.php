<?php

namespace App\Imports;

use App\Models\QtyByLocation;
use Maatwebsite\Excel\Concerns\ToModel;

class QtyByLocationsImport implements ToModel
{
    public function model(array $row)
    : QtyByLocation
    {
        return new QtyByLocation([
            "province" => $row[0],
            "vaccine" => $row[1],
            "first_dose" => $row[2],
            "second_dose" => $row[3]
        ]);
    }
}
