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
        DB::table('permissions')
            ->insert([
                [
                    'name' => 'Create User',
                    'slug' => 'create-user',
                    'description' => 'Ability to create a new user.'
                ],
                [
                    'name' => 'Update User',
                    'slug' => 'update-user',
                    'description' => 'Ability to update an existing user.'
                ],
                [
                    'name' => 'Delete User',
                    'slug' => 'delete-user',
                    'description' => 'Ability to delete a user.'
                ],
                [
                    'name' => 'Force Delete User',
                    'slug' => 'force-delete-user',
                    'description' => 'Ability to force delete a user.'
                ],
                [
                    'name' => 'View User',
                    'slug' => 'view-user',
                    'description' => 'Ability to view a user.'
                ],
                [
                    'name' => 'Restore User',
                    'slug' => 'restore-user',
                    'description' => 'Ability to restore a deleted user.'
                ]
            ]);
    }
}
