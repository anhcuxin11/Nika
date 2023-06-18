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
        for ($i = 2; $i <= $limit; $i++) {
            DB::table('candidates')->insert([
                'firstname' => $fake->firstname,
                'lastname' => $fake->lastname,
                'email' => $fake->email,
                'password' => Hash::make('tBa6KUSU97ZZBhga'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
