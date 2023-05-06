<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Industry::$name as $item) {
            Industry::create([
                'name' => $item,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
