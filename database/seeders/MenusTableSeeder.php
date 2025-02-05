<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::insert([
            ["id" => 1, "name" => "Dashboard", "description" => "Home Page", "key" => "dashboard", "parent_id" => 0, "url" => "/", "icon" => "fa fa-dashboard", "order" => 1, "active" => 1, "link_rights" => 0, "created_at" => now(), "created_by" => 1],
            ["id" => 2, "name" => "Settings", "description" => "Administration Settings", "key" => "settings", "parent_id" => 0, "url" => "#", "icon" => "fa fa-shield", "order" => 3, "active" => 1, "link_rights" => 0, "created_at" => now(), "created_by" => 1],
            ["id" => 3, "name" => "User Settings", "description" => "User Settings", "key" => "user", "parent_id" => 2, "url" => "user", "icon" => null, "order" => 1, "active" => 1, "link_rights" => 0, "created_at" => now(), "created_by" => 1],
            ["id" => 4, "name" => "Menu Settings", "description" => "Menu Settings", "key" => "menu", "parent_id" => 2, "url" => "menu", "icon" => "fa fa-plus-square", "order" => 2, "active" => 1, "link_rights" => 0, "created_at" => now(), "created_by" => 1],
            ["id" => 5, "name" => "Role Settings", "description" => "Role Settings", "key" => "role", "parent_id" => 2, "url" => "role", "icon" => "fa fa-diamond", "order" => 3, "active" => 1, "link_rights" => 0, "created_at" => now(), "created_by" => 1],
            ["id" => 6, "name" => "Report", "description" => "Report", "key" => "report", "parent_id" => 0, "url" => "#", "icon" => "fa fa-cube", "order" => 2, "active" => 1, "link_rights" => 0, "created_at" => now(), "created_by" => 1],
            ["id" => 7, "name" => "Add", "description" => "Add User", "key" => "ADD", "parent_id" => 3, "url" => "user/create", "icon" => null, "order" => 1, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 8, "name" => "Edit", "description" => "Edit User", "key" => "EDIT", "parent_id" => 3, "url" => "user/{user}/edit", "icon" => null, "order" => 3, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 9, "name" => "Add", "description" => "Add Menu", "key" => "ADD", "parent_id" => 4, "url" => "menu/create", "icon" => null, "order" => 1, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 10, "name" => "Edit", "description" => "Edit Menu", "key" => "EDIT", "parent_id" => 4, "url" => "menu/{menu}/edit", "icon" => null, "order" => 3, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 11, "name" => "Add", "description" => "Add Menu", "key" => "ADD", "parent_id" => 5, "url" => "role/create", "icon" => null, "order" => 1, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 12, "name" => "Edit", "description" => "Edit Menu", "key" => "EDIT", "parent_id" => 5, "url" => "role/{role}/edit", "icon" => null, "order" => 3, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 13, "name" => "Summary Report", "description" => "Summary", "key" => "summary", "parent_id" => 6, "url" => "summary", "icon" => null, "order" => 2, "active" => 1, "link_rights" => 0, "created_at" => now(), "created_by" => 1],
            ["id" => 14, "name" => "Case Report", "description" => "Case Based Report", "key" => "case", "parent_id" => 6, "url" => "case", "icon" => null, "order" => 1, "active" => 1, "link_rights" => 0, "created_at" => now(), "created_by" => 1],
            ["id" => 15, "name" => "Store", "description" => "Store Menu", "key" => "STORE", "parent_id" => 5, "url" => "role", "icon" => null, "order" => 2, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 16, "name" => "Update", "description" => "Update Menu", "key" => "UPDATE", "parent_id" => 5, "url" => "role/{role}", "icon" => null, "order" => 4, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 17, "name" => "Store", "description" => "Save User", "key" => "STORE", "parent_id" => 3, "url" => "user", "icon" => 2, "order" => 2, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 18, "name" => "Update", "description" => "Update User", "key" => "UPDATE", "parent_id" => 3, "url" => "user/{user}", "icon" => null, "order" => 4, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 19, "name" => "Store", "description" => "Store Menu", "key" => "STORE", "parent_id" => 4, "url" => "menu", "icon" => null, "order" => 2, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1],
            ["id" => 20, "name" => "Update", "description" => "Update Menu", "key" => "UPDATE", "parent_id" => 4, "url" => "menu/{menu}", "icon" => null, "order" => 4, "active" => 1, "link_rights" => 1, "created_at" => now(), "created_by" => 1]
        ]);
    }
}
