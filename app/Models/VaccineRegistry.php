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

    public function scopeGender($query, $type)
    {
        return $query->where('gender', $type);
    }

    public function scopeAgeRange($query, $type)
    {
        return $query->where('age_range', $type);
    }

    public function scopeProvinceOfResidence($query, $type)
    {
        return $query->where('province_of_residence', $type);
    }

    public function scopeCityOfResidence($query, $type)
    {
        return $query->where('city_of_residence', $type);
    }

    public function scopeVaccinatedInProvince($query, $type)
    {
        return $query->where('vaccinated_in_the_province', $type);
    }

    public function scopeVaccinatedInCity($query, $type)
    {
        return $query->where('vaccinated_in_the_city', $type);
    }

    public function scopeVaccinationDate($query, $type)
    {
        return $query->where('vaccination_date', $type);
    }

    public function scopeVaccine($query, $type)
    {
        return $query->where('vaccine', $type);
    }

    public function scopeVaccinationCondition($query, $type)
    {
        return $query->where('vaccination_condition', $type);
    }
}
