<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QtyByLocation extends Model
{
    protected $fillable = [
        "province", "vaccine", "first_dose", "second_dose"
    ];
}
