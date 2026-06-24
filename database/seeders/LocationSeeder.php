<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LocationSeeder extends Seeder
{
    public function run()
    {
        Log::debug('Seed locations');
        
        Location::truncate();

        
        $mainCampus      = Company::where('name', 'MinSU Main Campus')->first();
        $calapanCampus   = Company::where('name', 'MinSU Calapan Campus')->first();
        $bongabongCampus = Company::where('name', 'MinSU Bongabong Campus')->first();

        
        $admin = User::where('permissions->superuser', '1')->first() ?? User::factory()->firstAdmin()->create();

        
        $locations = [
            // --- Main Campus Offices ---
            [
                'name'       => 'Office of the President',
                'company_id' => $mainCampus?->id,
                'city'       => 'Victoria',
                'address'    => 'MinSU Main Campus Base',
            ],
            [
                'name'       => 'CTE Faculty', // College of Teacher Education
                'company_id' => $mainCampus?->id,
                'city'       => 'Victoria',
                'address'    => 'CTE Building',
            ],
            [
                'name'       => 'Cashier',
                'company_id' => $mainCampus?->id,
                'city'       => 'Victoria',
                'address'    => 'Administration Building',
            ],
            [
                'name'       => 'Supply Office',
                'company_id' => $mainCampus?->id,
                'city'       => 'Victoria',
                'address'    => 'Administration Building',
            ],
            [
                'name'       => 'Extension Office',
                'company_id' => $mainCampus?->id,
                'city'       => 'Victoria',
                'address'    => 'Research and Extension Building',
            ],

            // --- Calapan Campus Offices ---
            [
                'name'       => 'CBM Faculty', // College of Business and Management
                'company_id' => $calapanCampus?->id,
                'city'       => 'Calapan City',
                'address'    => 'CBM Building',
            ],
            [
                'name'       => 'Library',
                'company_id' => $calapanCampus?->id,
                'city'       => 'Calapan City',
                'address'    => 'Campus Library Building',
            ],
            [
                'name'       => 'Guidance Office',
                'company_id' => $calapanCampus?->id,
                'city'       => 'Calapan City',
                'address'    => 'Student Services Building',
            ],

            // --- Bongabong Campus Offices ---
            [
                'name'       => 'IT Faculty', 
                'company_id' => $bongabongCampus?->id,
                'city'       => 'Bongabong',
                'address'    => 'CCS Laboratory Building',
            ],
            [
                'name'       => 'Registrar',
                'company_id' => $bongabongCampus?->id,
                'city'       => 'Bongabong',
                'address'    => 'Administration Wing',
            ],
            [
                'name'       => 'Research Office',
                'company_id' => $bongabongCampus?->id,
                'city'       => 'Bongabong',
                'address'    => 'Research and Innovation Hub',
            ],
            [
                'name'       => 'CED Office', 
                'company_id' => $bongabongCampus?->id,
                'city'       => 'Bongabong',
                'address'    => 'Main Academic Block',
            ],
        ];

        // Safely loop through and instantiate records directly into the DB using Eloquent
        foreach ($locations as $location) {
            Location::create([
                'name'       => $location['name'],
                'company_id' => $location['company_id'],
                'city'       => $location['city'],
                'address'    => $location['address'],
                'state'      => 'Oriental Mindoro',
                'country'    => 'PH',
                'user_id'    => $admin->id, // Populates structural creator track
            ]);
        }
    }
}
