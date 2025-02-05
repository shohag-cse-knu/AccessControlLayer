<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'Super Admin', 'description' => 'Super Admin', 'created_at' => now(), 'created_by' => 1],
            ['name' => 'Admin', 'description' => 'Admin', 'created_at' => now(), 'created_by' => 1],
            ['name' => 'Report Viewer', 'description' => 'Report Viewer', 'created_at' => now(), 'created_by' => 1],
            ['name' => 'App User', 'description' => 'Mobile App User', 'created_at' => now(), 'created_by' => 1],
        ]);
    }
}
