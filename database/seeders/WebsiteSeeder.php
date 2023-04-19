<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websites = [
            ['name' => 'Skype', 'url' => 'skype.com'],
            ['name' => 'Facebook', 'url' => 'facebook.com'],
            ['name' => 'Twitter', 'url' => 'twitter.com'],
            ['name' => 'Inisev', 'url' => 'inisev.com'],
            ['name' => 'Viber', 'url' => 'viber.com'],
        ];

        DB::table('websites')->insert($websites);
    }
}
