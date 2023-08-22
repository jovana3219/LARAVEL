<?php

namespace Database\Seeders;

use App\Models\Proizvod;
use Illuminate\Database\Seeder;

class ProizvodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            Proizvod::create([
                'naziv' => $faker->firstName(),
                'cena' => $faker->numberBetween(250,1500),
                'ukusId' =>  $faker->numberBetween(1,6),
                'tipId' =>  $faker->numberBetween(1,4)
            ]);
        }
    }
}
