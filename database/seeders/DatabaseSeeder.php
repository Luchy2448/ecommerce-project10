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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //  \App\Models\CmsPage::factory(7)->create();


        // $this->call(AdminsTableSeeder::class);
        // $this->call(CmsPageTableSeeder::class);
        $this->call(CategoryTableSeeder::class);

    }
}
