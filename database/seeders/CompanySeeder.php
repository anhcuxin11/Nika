<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
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
            DB::table('companies')->insert([
                'name' => $fake->name,
                'phone' => $fake->phoneNumber,
                'email' => $fake->email,
                'company_no' => 12312312,
                'status' => 1,
                'address' => $fake->address,
                'name_person' => $fake->name,
                'phone_company' => $fake->phoneNumber,
                'email_company' => $fake->email,
                'fax_company' => $fake->phoneNumber,
                'password' => Hash::make('tBa6KUSU97ZZBhga'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
