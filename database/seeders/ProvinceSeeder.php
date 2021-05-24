<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    private array $provinces = [
       "Buenos Aires",
       "CABA",
       "Catamarca",
       "Chaco",
       "Chubut",
       "Cordoba",
       "Corrientes",
       "Entre Rios",
       "Formosa",
       "Jujuy",
       "La Pampa",
       "La Rioja",
       "Mendoza",
       "Misiones",
       "Neuquen",
       "Rio Negro",
       "S.I.",
       "Salta",
       "San Juan",
       "San Luis",
       "Santa Cruz",
       "Santa Fe",
       "Santiago del Estero",
       "Tierra del Fuego",
       "Tucuman",
     ];

    public function run()
    {
        array_map(function($province){
            Province::create(["name" => $province]);
        }, $this->provinces);
    }
}
