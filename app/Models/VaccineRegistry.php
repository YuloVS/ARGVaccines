<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineRegistry extends Model
{
    protected $fillable = [
        "gender", "age_range", "province_of_residence", "city_of_residence", "vaccinated_in_the_province",
        "vaccinated_in_the_city", "vaccination_date", "vaccine", "vaccination_condition"
    ];

    public function scopeProvinceOfResidence($query, $type)
    {
        return $query->where('province_of_residence', $type);
    }
}
