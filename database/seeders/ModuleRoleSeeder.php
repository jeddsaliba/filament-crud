<?php

namespace Database\Seeders;

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
        for ($role_id = 1; $role_id < 4; $role_id++) {
            for ($module_id = 1; $module_id < 8; $module_id++) {
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
