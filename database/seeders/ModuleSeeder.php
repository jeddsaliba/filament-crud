<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')
            ->insert([
                [
                    'name' => 'Project',
                    'slug' => 'project',
                    'description' => 'Module for managing projects.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Role',
                    'slug' => 'role',
                    'description' => 'Module for managing roles.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Status',
                    'slug' => 'status',
                    'description' => 'Module for managing statuses.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Tag',
                    'slug' => 'tag',
                    'description' => 'Module for managing tags.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Task',
                    'slug' => 'task',
                    'description' => 'Module for managing tasks.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'User',
                    'slug' => 'user',
                    'description' => 'Module for managing users.',
                    'can_edit' => false,
                    'can_delete' => false
                ],
                [
                    'name' => 'Permission',
                    'slug' => 'permission',
                    'description' => 'Module for managing permissions.',
                    'can_edit' => false,
                    'can_delete' => false
                ]
            ]);
    }
}
