<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    private  $categories = [
        1 => [
            'slot'=> "sport",
            'title'=>"Спорт"
        ],
        2 => [
            'slot'=> "politics",
            'title'=>"Политика"
        ],
        3 => [
            'slot'=> "financial",
            'title'=>"Финансы"
        ],
        4 => [
            'slot'=> "health",
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
