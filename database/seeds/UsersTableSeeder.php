<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'lss',
            'email' => 'lss@lss.ru',
            'password' => bcrypt('1'),
        ]);
    }
}
