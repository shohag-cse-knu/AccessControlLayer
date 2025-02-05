<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Syfur Rahaman Shohag', 
                'username' => 'syfur.srs', 
                'email' => 'syfur.srs@gmail.com',
                'mobile' => '01676332242',
                'password' => bcrypt('123'),
                'role_id' => 1,
                'designation' => 'Programmer',
                'created_at' => now(), 
                'created_by' => 1
            ],
        ]);
    }
}
