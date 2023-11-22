<?php

namespace Database\Seeders;

use App\Enum\Role;
use App\Models\User;
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
            ['name' => 'Administrator', 'email' => 'admin@insurance.com', 'password' => Hash::make('password'), 'role' => Role::ROLES[0]],
            ['name' => 'User', 'email' => 'user@insurance.com', 'password' => Hash::make('password'), 'role' => Role::ROLES[1]],
            ['name' => 'Agent', 'email' => 'agent@insurance.com', 'password' => Hash::make('password'), 'role' => Role::ROLES[2]],
            ['name' => 'Shix Insurance', 'email' => 'shix@insurance.com', 'password' => Hash::make('password'), 'role' => Role::ROLES[2]]
        ];

        User::query()->delete();
        foreach ($users as $user) {
            User::query()->create($user);
        }
    }
}
