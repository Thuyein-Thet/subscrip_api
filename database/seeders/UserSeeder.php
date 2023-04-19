<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['email' => 'john@mail.com'],
            ['email' => 'smith@mail.com'],
            ['email' => 'woo@mail.com'],
            ['email' => 'thet@mail.com'],
            ['email' => 'aung@mail.com'],
            ['email' => 'thuyein.thet555@gmail.com'],
            ['email' => 'eimon30715@gmail.com'],
        ];

        DB::table('users')->insert($users);

    }
}
