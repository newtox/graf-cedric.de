<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::query()->create([
            'name' => 'AdminUser',
            'email' => 'admin@admin.com',
            'password' => bcrypt('AdminPassword'),
        ]);
    }
}
