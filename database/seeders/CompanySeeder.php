<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::debug('Seed companies');
        
        // Clear existing companies to prevent duplicate entry errors
        Company::truncate();

        // Define your exact campus entries instead of using the random factory
        $campuses = [
            ['name' => 'MinSU Main Campus'],
            ['name' => 'MinSU Calapan Campus'],
            ['name' => 'MinSU Bongabong Campus'],
        ];

        // Insert the specific records into the database
        foreach ($campuses as $campus) {
            Company::create($campus);
        }

        // --- Keep original image/file copying logic ---
        $src = public_path('/img/demo/companies/');
        $dst = 'companies'.'/';
        $del_files = Storage::files('companies/'.$dst);

        foreach ($del_files as $del_file) { // iterate files
            $file_to_delete = str_replace($src, '', $del_file);
            Log::debug('Deleting: '.$file_to_delete);
            try {
                Storage::disk('public')->delete($dst.$del_file);
            } catch (\Exception $e) {
                Log::debug($e);
            }
        }

        $add_files = glob($src.'/*.*');
        foreach ($add_files as $add_file) {
            $file_to_copy = str_replace($src, '', $add_file);
            Log::debug('Copying: '.$file_to_copy);
            try {
                Storage::disk('public')->put($dst.$file_to_copy, file_get_contents($src.$file_to_copy));
            } catch (\Exception $e) {
                Log::debug($e);
            }
        }
    }
}
