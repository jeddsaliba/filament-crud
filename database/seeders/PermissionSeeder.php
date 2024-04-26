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
                    'name' => 'Create Project',
                    'slug' => 'create-project',
                    'description' => 'Ability to create a new project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Update Project',
                    'slug' => 'update-project',
                    'description' => 'Ability to update an existing project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Delete Project',
                    'slug' => 'delete-project',
                    'description' => 'Ability to delete a project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Force Delete Project',
                    'slug' => 'force-delete-project',
                    'description' => 'Ability to force delete a project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'View Project',
                    'slug' => 'view-project',
                    'description' => 'Ability to view a project.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Restore Project',
                    'slug' => 'restore-project',
                    'description' => 'Ability to restore a deleted project.',
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
                    'name' => 'Create Role',
                    'slug' => 'create-role',
                    'description' => 'Ability to create a new role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Update Role',
                    'slug' => 'update-role',
                    'description' => 'Ability to update an existing role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Delete Role',
                    'slug' => 'delete-role',
                    'description' => 'Ability to delete a role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Force Delete Role',
                    'slug' => 'force-delete-role',
                    'description' => 'Ability to force delete a role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'View Role',
                    'slug' => 'view-role',
                    'description' => 'Ability to view a role.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Restore Role',
                    'slug' => 'restore-role',
                    'description' => 'Ability to restore a deleted role.',
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
                    'name' => 'Create Status',
                    'slug' => 'create-status',
                    'description' => 'Ability to create a new status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Update Status',
                    'slug' => 'update-status',
                    'description' => 'Ability to update an existing status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Delete Status',
                    'slug' => 'delete-status',
                    'description' => 'Ability to delete a status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Force Delete Status',
                    'slug' => 'force-delete-status',
                    'description' => 'Ability to force delete a status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'View Status',
                    'slug' => 'view-status',
                    'description' => 'Ability to view a status.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Restore Status',
                    'slug' => 'restore-status',
                    'description' => 'Ability to restore a deleted status.',
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
                    'name' => 'Create Tag',
                    'slug' => 'create-tag',
                    'description' => 'Ability to create a new tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Update Tag',
                    'slug' => 'update-tag',
                    'description' => 'Ability to update an existing tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Delete Tag',
                    'slug' => 'delete-tag',
                    'description' => 'Ability to delete a tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Force Delete Tag',
                    'slug' => 'force-delete-tag',
                    'description' => 'Ability to force delete a tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'View Tag',
                    'slug' => 'view-tag',
                    'description' => 'Ability to view a tag.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Restore Tag',
                    'slug' => 'restore-tag',
                    'description' => 'Ability to restore a deleted tag.',
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
                    'name' => 'Create Task',
                    'slug' => 'create-task',
                    'description' => 'Ability to create a new task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Update Task',
                    'slug' => 'update-task',
                    'description' => 'Ability to update an existing task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Delete Task',
                    'slug' => 'delete-task',
                    'description' => 'Ability to delete a task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Force Delete Task',
                    'slug' => 'force-delete-task',
                    'description' => 'Ability to force delete a task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'View Task',
                    'slug' => 'view-task',
                    'description' => 'Ability to view a task.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Restore Task',
                    'slug' => 'restore-task',
                    'description' => 'Ability to restore a deleted task.',
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
                    'name' => 'Create User',
                    'slug' => 'create-user',
                    'description' => 'Ability to create a new user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Update User',
                    'slug' => 'update-user',
                    'description' => 'Ability to update an existing user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Delete User',
                    'slug' => 'delete-user',
                    'description' => 'Ability to delete a user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Force Delete User',
                    'slug' => 'force-delete-user',
                    'description' => 'Ability to force delete a user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'View User',
                    'slug' => 'view-user',
                    'description' => 'Ability to view a user.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Restore User',
                    'slug' => 'restore-user',
                    'description' => 'Ability to restore a deleted user.',
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
                    'name' => 'Create Permission',
                    'slug' => 'create-permission',
                    'description' => 'Ability to create a new permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Update Permission',
                    'slug' => 'update-permission',
                    'description' => 'Ability to update an existing permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Delete Permission',
                    'slug' => 'delete-permission',
                    'description' => 'Ability to delete a permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Force Delete Permission',
                    'slug' => 'force-delete-permission',
                    'description' => 'Ability to force delete a permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'View Permission',
                    'slug' => 'view-permission',
                    'description' => 'Ability to view a permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Restore Permission',
                    'slug' => 'restore-permission',
                    'description' => 'Ability to restore a deleted permission.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);
    }
}
