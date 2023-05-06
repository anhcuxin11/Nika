<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::insert([
            [
                'name' => Language::$name[0],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Language::$name[1],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Language::$name[2],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Language::$name[3],
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'name' => Language::$name[4],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
