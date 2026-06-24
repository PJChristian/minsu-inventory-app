<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::truncate();

        // Ensure locations exist before assigning them
        if (!Location::count()) {
            $this->call(LocationSeeder::class);
        }

        // Fetch your MinSU campuses from the CompanySeeder
        $mainCampus      = Company::where('name', 'MinSU Main Campus')->first();
        $calapanCampus   = Company::where('name', 'MinSU Calapan Campus')->first();
        $bongabongCampus = Company::where('name', 'MinSU Bongabong Campus')->first();

        // Optional: Find an admin user to act as the department head/manager if needed
        $admin = User::where('permissions->superuser', '1')->first() ?? User::factory()->firstAdmin()->create();

        // Build your department array with explicit company mapping
        $departments = [
            [
                'name'       => 'College of Computer Studies',
                'tag_color'  => '#1e3a8a',
                'notes'      => 'CCS Department',
                'company_id' => $bongabongCampus?->id, // Assigned to Bongabong
            ],
            [
                'name'       => 'Institute of Fisheries',
                'tag_color'  => '#0d9488',
                'notes'      => 'IF Department',
                'company_id' => $bongabongCampus?->id, // Assigned to Bongabong
            ],
            [
                'name'       => 'College of Teacher Education', // Fixed typo: Added "of"
                'tag_color'  => '#d97706',
                'notes'      => 'CTE Department',
                'company_id' => $mainCampus?->id, // Assigned to Main
            ],
            [
                'name'       => 'Administration',
                'tag_color'  => '#4b5563',
                'notes'      => 'Admin Department',
                'company_id' => $mainCampus?->id, // Assigned to Main
            ],
            [
                'name'       => 'College of Business and Management',
                'tag_color'  => '#7c3aed',
                'notes'      => 'CBM Department',
                'company_id' => $calapanCampus?->id, // Assigned to Calapan
            ],
        ];

        foreach ($departments as $department) {
            // Find a location specific to this campus to prevent mix-ups
            $location = Location::where('company_id', $department['company_id'])->first() ?? Location::first();

            Department::create([
                'name'        => $department['name'],
                'tag_color'   => $department['tag_color'],
                'notes'       => $department['notes'],
                'company_id'  => $department['company_id'], // Standard Snipe-IT field
                'location_id' => $location?->id,           // Safe fallback location
                'user_id'     => $admin->id,                // Standard Snipe-IT field for Manager
            ]);
        }
    }
}
