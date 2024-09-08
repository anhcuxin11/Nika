<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResumeSeeder extends Seeder
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
            DB::table('resumes')->insert([
                'candidate_id' => $i,
                'sex' => rand(1, 0),
                'country' => 'Viet Nam',
                'phone' => $fake->phoneNumber,
                'address' => $fake->address,
                'facebook' => null,
                'current_salary' => rand(500, 1500),
                'skill' => 'HTML, PHP, CSS',
                'certificate' => 'Toeic 700',
                'hobby' => 'Game, Cau Long',
                'memo' => 'Lanh lung, Biet lang nghe',
            ]);
        }
    }
}
