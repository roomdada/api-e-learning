<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
          'name' => 'Côte d\'Ivoire',
          'acronym' => 'CI',
        ]);

        Country::create([
          'name' => 'Ghana',
          'acronym' => 'GH',
        ]);

        Country::create([
          'name' => 'Togo',
          'acronym' => 'TG',
        ]);
    }
}
