<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Str;

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

        $directory = 'company';
        Storage::disk('public')->deleteDirectory($directory);

        $originalPath = 'images/company/avatar5.jpg';
        $fileName = FileFacade::basename($originalPath);
        $fileExtension = FileFacade::extension($originalPath);

        for ($i = 1; $i <= $limit; $i++) {
            $destinationPath = $directory . '/'. $i . '/' . Str::random() . '.' . $fileExtension;
            $file = new File(public_path($originalPath));
            Storage::disk('public')->putFileAs('', $file, $destinationPath);

            DB::table('companies')->insert([
                'name' => $fake->name,
                'phone' => $fake->phoneNumber,
                'email' => 'thinh'. $i . '@gmail.com',
                'company_no' => 12312312,
                'status' => 1,
                'address' => $fake->address,
                'name_person' => $fake->name,
                'phone_company' => $fake->phoneNumber,
                'email_company' => $fake->email,
                'fax_company' => $fake->phoneNumber,
                'password' => Hash::make('thinh@0501'),
                'upload_file_name' => $fileName,
                'upload_file_path' => $destinationPath,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
