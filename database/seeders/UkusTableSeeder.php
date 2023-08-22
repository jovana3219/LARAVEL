<?php

namespace Database\Seeders;

use App\Models\Ukus;
use Illuminate\Database\Seeder;

class UkusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ukus::create([
            'ukus' => 'Cokolada'
        ]);
        
        Ukus::create([
            'ukus' => 'Borovnica'
        ]);

        Ukus::create([
            'ukus' => 'Vanila'
        ]);

        Ukus::create([
            'ukus' => 'Lesnik'
        ]);

        Ukus::create([
            'ukus' => 'Pistaci'
        ]);

        Ukus::create([
            'ukus' => 'Jagoda'
        ]);

    }
}
