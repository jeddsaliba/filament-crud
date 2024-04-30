<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')
            ->insert([
                [
                    'name' => 'Pending',
                    'color' => '#dc2626',
                    'can_edit' => false,
                    'can_delete' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Ongoing',
                    'color' => '#d97706',
                    'can_edit' => false,
                    'can_delete' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Completed',
                    'color' => '#16a34a',
                    'can_edit' => false,
                    'can_delete' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
    }
}
