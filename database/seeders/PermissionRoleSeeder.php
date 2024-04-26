<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    const managerPermissionIds = [
        1, 2, 3, 5, 6, 19, 20, 21, 23, 24, 25, 26, 27, 29, 30, 31, 32, 33, 35, 36
    ];
    const userPermissionIds = [
        1, 2, 3, 5, 6, 19, 20, 21, 23, 24, 25, 26, 27, 29, 30
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insertData = [];
        /** INSERT PERMISSION FOR ADMINISTRATOR */
        for ($permission_id = 1; $permission_id < 43; $permission_id++) {
            $insertData[] = [
                'role_id' => 1,
                'permission_id' => $permission_id
            ];
        }
        /** INSERT PERMISSION FOR MANAGER */
        for ($permission_id = 1; $permission_id < 43; $permission_id++) {
            if (in_array($permission_id, self::managerPermissionIds)) {
                $insertData[] = [
                    'role_id' => 2,
                    'permission_id' => $permission_id
                ];
            }
        }
        /** INSERT PERMISSION FOR USER */
        for ($permission_id = 1; $permission_id < 43; $permission_id++) {
            if (in_array($permission_id, self::userPermissionIds)) {
                $insertData[] = [
                    'role_id' => 3,
                    'permission_id' => $permission_id
                ];
            }
        }
        DB::table('permission_role')
            ->insert($insertData);
    }
}
