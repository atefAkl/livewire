<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::generateFor('users');
        Permission::generateFor('roles');
        Permission::generateFor('permissions');
        Permission::generateFor('cities');
        Permission::generateFor('countries');
    }
}
