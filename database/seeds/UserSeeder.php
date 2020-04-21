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
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'stasya0903@mail.ru',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => true
            ]
        ]);
    }
}
