<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insertData = [];
        $countRoles = Role::count();
        $countModules = Module::count();
        for ($role_id = 1; $role_id <= $countRoles; $role_id++) {
            for ($module_id = 1; $module_id <= $countModules; $module_id++) {
                $insertData[] = [
                    'role_id' => $role_id,
                    'module_id' => $module_id
                ];
            }
        }
        DB::table('module_role')
            ->insert($insertData);
    }
}
