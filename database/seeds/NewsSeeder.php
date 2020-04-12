<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('news')->insert($this->getData());
    }

    private function getData()
    {
        $faker = Faker\Factory::create('ru_RU');

        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'category_id'=> rand(1,4),
                'title' => $faker->realText(rand(20,50)),
                'text' => $faker->realText(rand(1000,3000)),
                'isPrivate' => (bool)rand(0, 1),
            ];
        }
        return $data;
    }
}
