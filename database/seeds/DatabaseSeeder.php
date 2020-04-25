<?php

use App\Resource;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(CategoriesSeeder::class);
        $this->call(ResourceSeeder::class);
        $this->call(UserSeeder::class);
    }
}
