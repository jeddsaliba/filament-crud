<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * INSERT PERMISSIONS FOR PROJECT MODULE
         */
        DB::table('permissions')
            ->insert([
                [
                    'module_id' => 1,
                    'name' => 'Create Project',
                    'slug' => 'project:create',
                    'description' => 'Ability to create a new project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 1,
                    'name' => 'Update Project',
                    'slug' => 'project:update',
                    'description' => 'Ability to update an existing project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 1,
                    'name' => 'Delete Project',
                    'slug' => 'project:delete',
                    'description' => 'Ability to delete a project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 1,
                    'name' => 'Force Delete Project',
                    'slug' => 'project:force-delete',
                    'description' => 'Ability to force delete a project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 1,
                    'name' => 'View Project',
                    'slug' => 'project:detail',
                    'description' => 'Ability to view a project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 1,
                    'name' => 'Restore Project',
                    'slug' => 'project:restore',
                    'description' => 'Ability to restore a deleted project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 1,
                    'name' => 'List Project',
                    'slug' => 'project:pagination',
                    'description' => 'Ability to view list of projects.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);

        /**
         * INSERT PERMISSIONS FOR ROLE MODULE
         */
        DB::table('permissions')
            ->insert([
                [
                    'module_id' => 2,
                    'name' => 'Create Role',
                    'slug' => 'role:create',
                    'description' => 'Ability to create a new role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 2,
                    'name' => 'Update Role',
                    'slug' => 'role:update',
                    'description' => 'Ability to update an existing role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 2,
                    'name' => 'Delete Role',
                    'slug' => 'role:delete',
                    'description' => 'Ability to delete a role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 2,
                    'name' => 'Force Delete Role',
                    'slug' => 'role:force-delete',
                    'description' => 'Ability to force delete a role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 2,
                    'name' => 'View Role',
                    'slug' => 'role:detail',
                    'description' => 'Ability to view a role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 2,
                    'name' => 'Restore Role',
                    'slug' => 'role:restore',
                    'description' => 'Ability to restore a deleted role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 2,
                    'name' => 'List Role',
                    'slug' => 'role:pagination',
                    'description' => 'Ability to view list of roles.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);

        /**
         * INSERT PERMISSIONS FOR STATUS MODULE
         */
        DB::table('permissions')
            ->insert([
                [
                    'module_id' => 3,
                    'name' => 'Create Status',
                    'slug' => 'status:create',
                    'description' => 'Ability to create a new status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 3,
                    'name' => 'Update Status',
                    'slug' => 'status:update',
                    'description' => 'Ability to update an existing status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 3,
                    'name' => 'Delete Status',
                    'slug' => 'status:delete',
                    'description' => 'Ability to delete a status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 3,
                    'name' => 'Force Delete Status',
                    'slug' => 'status:force-delete',
                    'description' => 'Ability to force delete a status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 3,
                    'name' => 'View Status',
                    'slug' => 'status:detail',
                    'description' => 'Ability to view a status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 3,
                    'name' => 'Restore Status',
                    'slug' => 'status:restore',
                    'description' => 'Ability to restore a deleted status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 3,
                    'name' => 'List Status',
                    'slug' => 'status:pagination',
                    'description' => 'Ability to view list of statuses.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);

        /**
         * INSERT PERMISSIONS FOR TAG MODULE
         */
        DB::table('permissions')
            ->insert([
                [
                    'module_id' => 4,
                    'name' => 'Create Tag',
                    'slug' => 'tag:create',
                    'description' => 'Ability to create a new tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 4,
                    'name' => 'Update Tag',
                    'slug' => 'tag:update',
                    'description' => 'Ability to update an existing tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 4,
                    'name' => 'Delete Tag',
                    'slug' => 'tag:delete',
                    'description' => 'Ability to delete a tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 4,
                    'name' => 'Force Delete Tag',
                    'slug' => 'tag:force-delete',
                    'description' => 'Ability to force delete a tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 4,
                    'name' => 'View Tag',
                    'slug' => 'tag:detail',
                    'description' => 'Ability to view a tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 4,
                    'name' => 'Restore Tag',
                    'slug' => 'tag:restore',
                    'description' => 'Ability to restore a deleted tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 4,
                    'name' => 'List Tag',
                    'slug' => 'tag:pagination',
                    'description' => 'Ability to view list of tags.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);
        
        /**
         * INSERT PERMISSIONS FOR TASK MODULE
         */
        DB::table('permissions')
            ->insert([
                [
                    'module_id' => 5,
                    'name' => 'Create Task',
                    'slug' => 'task:create',
                    'description' => 'Ability to create a new task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 5,
                    'name' => 'Update Task',
                    'slug' => 'task:update',
                    'description' => 'Ability to update an existing task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 5,
                    'name' => 'Delete Task',
                    'slug' => 'task:delete',
                    'description' => 'Ability to delete a task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 5,
                    'name' => 'Force Delete Task',
                    'slug' => 'task:force-delete',
                    'description' => 'Ability to force delete a task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 5,
                    'name' => 'View Task',
                    'slug' => 'task:detail',
                    'description' => 'Ability to view a task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 5,
                    'name' => 'Restore Task',
                    'slug' => 'task:restore',
                    'description' => 'Ability to restore a deleted task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 5,
                    'name' => 'List Task',
                    'slug' => 'task:pagination',
                    'description' => 'Ability to view list of tasks.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);

        /**
         * INSERT PERMISSIONS FOR USER MODULE
         */
        DB::table('permissions')
            ->insert([
                [
                    'module_id' => 6,
                    'name' => 'Create User',
                    'slug' => 'user:create',
                    'description' => 'Ability to create a new user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 6,
                    'name' => 'Update User',
                    'slug' => 'user:update',
                    'description' => 'Ability to update an existing user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 6,
                    'name' => 'Delete User',
                    'slug' => 'user:delete',
                    'description' => 'Ability to delete a user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 6,
                    'name' => 'Force Delete User',
                    'slug' => 'user:force-delete',
                    'description' => 'Ability to force delete a user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 6,
                    'name' => 'View User',
                    'slug' => 'user:detail',
                    'description' => 'Ability to view a user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 6,
                    'name' => 'Restore User',
                    'slug' => 'user:restore',
                    'description' => 'Ability to restore a deleted user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 6,
                    'name' => 'List User',
                    'slug' => 'user:pagination',
                    'description' => 'Ability to view list of users.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);
        /**
         * INSERT PERMISSIONS FOR PERMISSION MODULE
         */
        DB::table('permissions')
            ->insert([
                [
                    'module_id' => 7,
                    'name' => 'Create Permission',
                    'slug' => 'permission:create',
                    'description' => 'Ability to create a new permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 7,
                    'name' => 'Update Permission',
                    'slug' => 'permission:update',
                    'description' => 'Ability to update an existing permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 7,
                    'name' => 'Delete Permission',
                    'slug' => 'permission:delete',
                    'description' => 'Ability to delete a permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 7,
                    'name' => 'Force Delete Permission',
                    'slug' => 'permission:force-delete',
                    'description' => 'Ability to force delete a permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 7,
                    'name' => 'View Permission',
                    'slug' => 'permission:detail',
                    'description' => 'Ability to view a permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 7,
                    'name' => 'Restore Permission',
                    'slug' => 'permission:restore',
                    'description' => 'Ability to restore a deleted permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 7,
                    'name' => 'List Permission',
                    'slug' => 'permission:pagination',
                    'description' => 'Ability to view list of permissions.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);
        /**
         * INSERT MODULES FOR PERMISSION MODULE
         */
        DB::table('permissions')
            ->insert([
                [
                    'module_id' => 8,
                    'name' => 'Create Module',
                    'slug' => 'module:create',
                    'description' => 'Ability to create a new module.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 8,
                    'name' => 'Update Module',
                    'slug' => 'module:update',
                    'description' => 'Ability to update an existing module.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 8,
                    'name' => 'Delete Module',
                    'slug' => 'module:delete',
                    'description' => 'Ability to delete a module.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 8,
                    'name' => 'Force Delete Module',
                    'slug' => 'module:force-delete',
                    'description' => 'Ability to force delete a module.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 8,
                    'name' => 'View Module',
                    'slug' => 'module:detail',
                    'description' => 'Ability to view a module.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 8,
                    'name' => 'Restore Module',
                    'slug' => 'module:restore',
                    'description' => 'Ability to restore a deleted module.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'module_id' => 8,
                    'name' => 'List Module',
                    'slug' => 'module:pagination',
                    'description' => 'Ability to view list of modules.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);
    }
}
