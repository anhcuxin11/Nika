<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CandidateSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(JobOccupationSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(OccupationSeeder::class);
        $this->call(ResumeSeeder::class);
    }
}
