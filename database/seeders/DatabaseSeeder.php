<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            ModuleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            StatusSeeder::class,
            ProjectSeeder::class,
            TaskSeeder::class,
            TagSeeder::class,
            ProjectTagSeeder::class,
            TagTaskSeeder::class,
            ModuleRoleSeeder::class,
            ModulePermissionRoleSeeder::class
        ]);
    }
}
