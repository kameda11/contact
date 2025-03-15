<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // \App\Models\User::factory(10)->create();
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            ContactsTableSeeder::class
        ]);
    }
}
