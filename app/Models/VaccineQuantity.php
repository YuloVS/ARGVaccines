<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineQuantity extends Model
{
    protected $fillable = ["vaccinated_in", "province", "quantity"];
}
