<?php

namespace Database\Seeders;

use App\Models\ModuleRole;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulePermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moduleRoleTable = (new ModuleRole)->getTable();
        $permissionsTable = (new Permission)->getTable();
        $query = DB::table($moduleRoleTable)
            ->select("$moduleRoleTable.role_id", "$permissionsTable.module_id", DB::raw("$permissionsTable.id as permission_id"))
            ->join($permissionsTable, "$moduleRoleTable.module_id", '=', "$permissionsTable.module_id")
            ->where(["$moduleRoleTable.role_id" => 1])->get();

        $query->each(function ($item) {
            DB::table('module_permission_role')
                ->insert([
                    'role_id' => $item->role_id,
                    'module_id' => $item->module_id,
                    'permission_id' => $item->permission_id
                ]);
        });
    }
}
