<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidad;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidad::create(['nombre' => 'METRO']);
        Unidad::create(['nombre' => 'PIEZA']);
        Unidad::create(['nombre' => 'DOCENA']);
        Unidad::create(['nombre' => 'PAR']);
        Unidad::create(['nombre' => 'BOBINA']);
    }
}
