<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')
            ->insert([
                [
                    'name' => 'Administrator',
                    'can_edit' => false,
                    'can_delete' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Manager',
                    'can_edit' => true,
                    'can_delete' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'User',
                    'can_edit' => true,
                    'can_delete' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
    }
}
