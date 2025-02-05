<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SuperAdminRole = Role::find(1); // Super Admin Role
        // Assign menus to roles
        $SuperAdminRole->menus()->sync([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]); // Super Admin has access to all menus
    }
}
