<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => Role::ROLES['Admin'],
            ],
            [
                'id' => 2,
                'name' => Role::ROLES['Agent'],
            ],
        ];

        Role::insert($roles);
    }
}
