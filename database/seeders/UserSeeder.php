<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('thovipma123'),
            'is_admin' => 1,
        ]);
    }
}
