<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    private  $categories = [
        1 => [
            'slug'=> "разное",
            'title'=>"разное"
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private function getData()
    {
        return $this->categories;
    }
}
