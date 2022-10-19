<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Talla;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $tallas = ['XS', 'S', 'L', 'XL', 'XXL'];
        foreach ($tallas as $t) {
            $talla=new Talla();
            $talla->nombre=$t;
            $talla->save();
        };
    }
}
