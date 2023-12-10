<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_permissions = Permission::all();

        $agent_permissions = Permission::whereIn('name', [
            'category_access',
            'category_show',
            'ticket_access',
            'ticket_show',
        ])->get();

        Role::findOrFail(1)->permissions()->sync($admin_permissions);
        Role::findOrFail(2)->permissions()->sync($agent_permissions);
    }
}
