<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QtyByLocation extends Model
{
    protected $fillable = [
        "province", "vaccine", "first_dose", "second_dose"
    ];

    public static function totalDoses($dose = null)
    {
        return $dose ?
            QtyByLocation::groupBy("province")->selectRaw("sum({$dose}) as total_{$dose}, province")->orderBy("total_{$dose}", "desc")->get() :
            QtyByLocation::groupBy("province")->selectRaw("sum(first_dose) as total_first_dose, sum(second_dose) as total_second_dose, province")->orderBy("total_first_dose", "desc")->get();
    }

    public static function totalFirstDoses()
    {
        return self::totalDoses("first_dose");
    }

    public static function totalSecondDoses()
    {
        return self::totalDoses("second_dose");
    }
}
