<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Location::$name as $item) {
            Location::create([
                'name' => $item,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
