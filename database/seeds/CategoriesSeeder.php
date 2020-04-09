<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    private  $categories = [
        1 => [
            'slug'=> "sport",
            'title'=>"Спорт"
        ],
        2 => [
            'slug'=> "politics",
            'title'=>"Политика"
        ],
        3 => [
            'slug'=> "financial",
            'title'=>"Финансы"
        ],
        4 => [
            'slug'=> "health",
            'title'=>"Здоровье"
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
