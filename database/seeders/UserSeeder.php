<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed one user to test the API
        User::factory([
            'name' => 'John Doe',
            'phone' => '12345678',
            'username' => 'john',
            'birthday' => now()->subDecades(3),
            'email' => 'john@gmail.com',
        ])->create();

        // Seed users to test the users list on the API
        User::factory(10)->create();
    }
}
