<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->getData());
    }

    private function getData()
    {
        $data = [
            'name' => 'admin',
            'email' => "stasya0903@mail.ru",
            'password' => '$2y$10$sMc.583LEGnE30MyhxrpjuPGEs5AuPcwxbMQ8..pz3.DFORR6LlcS'
        ];

        return $data;
    }

}
