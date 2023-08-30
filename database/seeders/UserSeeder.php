<?php

namespace Database\Seeders;

use App\Enum\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $users = [
            ['name' => 'Administrator', 'email' => 'admin@pos.com', 'password' => Hash::make('password'), 'role' => Role::ROLES[0]],
            ['name' => 'User', 'email' => 'user@pos.com', 'password' => Hash::make('password'), 'role' => Role::ROLES[1]],
            ['name' => 'Cashier', 'email' => 'cashier@pos.com', 'password' => Hash::make('password'), 'role' => Role::ROLES[3]],
            ['name' => 'Supervisor', 'email' => 'supervisor@pos.com', 'password' => Hash::make('password'), 'role' => Role::ROLES[4]],
        ];

        foreach ($users as $user) {
            User::query()->create($user);
        }
    }
}
