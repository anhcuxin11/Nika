<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Factory::create();
        $limit = 50;
        for ($i = 1; $i <= $limit; $i++) {
            DB::table('candidates')->insert([
                'firstname' => $fake->firstname,
                'lastname' => $fake->lastname,
                'email' => 'thinh'. $i . '@gmail.com',
                'password' => Hash::make('thinh@0501'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
