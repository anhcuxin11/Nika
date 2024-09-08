<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Occupation::$name as $name => $item) {
            Occupation::updateOrCreate(
                [
                    'name' => $name,
                ],
                [
                    'parent_id' => $item,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
