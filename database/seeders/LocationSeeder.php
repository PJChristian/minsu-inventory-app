<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LocationSeeder extends Seeder
{
    protected $adminuser;

    public function run()
    {
        Log::debug('Seed locations');
        
        Location::truncate();

        $mainCampus      = Company::where('name', 'MinSU Main Campus')->first();
        $calapanCampus   = Company::where('name', 'MinSU Calapan Campus')->first();
        $bongabongCampus = Company::where('name', 'MinSU Bongabong Campus')->first();

        // Assigning the admin user globally within the class run execution
        $this->adminuser = User::where('permissions->superuser', '1')->first() ?? User::factory()->firstAdmin()->create();

        $locations = [
            // --- Main Campus Offices ---
            [
                'name'       => 'Office of the President',
                'company_id' => $mainCampus?->id,
                'city'       => 'Victoria',
                'address'    => 'MinSU Main Campus Base',
            ],
            [
                'name'       => 'CTE Faculty', 
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
                'name'       => 'CBM Faculty', 
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

        // Seed using the updated columns structure
        foreach ($locations as $location) {
            Location::create([
                'name'       => $location['name'],
                'company_id' => $location['company_id'],
                'address'    => $location['address'],
                'address2'   => null,
                'city'       => $location['city'],
                'state'      => 'Oriental Mindoro', 
                'zip'        => '5200', 
                'country'    => 'PH', 
                'currency'   => 'PHP', 
                'image'      => rand(1, 9) . '.jpg',
                'tag_color'  => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT), 
                'notes'      => 'Created by DB seeder',
                'created_by'  => $this->adminuser->id, 
            ]);
        }
    }
}
