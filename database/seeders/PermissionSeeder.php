<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'name' => 'Manage Users',
                'slug' => 'manage-users',
                'description' => 'Can create, edit, and delete users'
            ],
            [
                'name' => 'Manage Hospitals',
                'slug' => 'manage-hospitals',
                'description' => 'Can manage hospital records'
            ],
            [
                'name' => 'Manage Specialties',
                'slug' => 'manage-specialties',
                'description' => 'Can manage medical specialties'
            ],
            [
                'name' => 'Manage Doctors',
                'slug' => 'manage-doctors',
                'description' => 'Can manage doctor profiles'
            ],
            [
                'name' => 'Manage Enquiries',
                'slug' => 'manage-enquiries',
                'description' => 'Can view and respond to business enquiries'
            ],
            [
                'name' => 'Manage Blogs',
                'slug' => 'manage-blogs',
                'description' => 'Can create, edit, and publish blog posts'
            ],
            [
                'name' => 'Manage Doctor Availability',
                'slug' => 'manage-doctor-availability',
                'description' => 'Can manage doctor schedules and availability'
            ],
            [
                'name' => 'View Consultations',
                'slug' => 'view-consultations',
                'description' => 'Can view patient consultations'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
