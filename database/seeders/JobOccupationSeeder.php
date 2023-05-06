<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobOccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 50) as $item) {
            DB::table('job_features')->insert([
                'job_id' => $item,
                'feature_id' => rand(1,12),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
