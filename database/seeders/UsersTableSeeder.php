<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Unknown author',
                'email' => 'unknown@mail.com',
                'password' => bcrypt(Str::random(16)),
            ],
            [
                'name' => 'Author',
                'email' => 'author@mail.com',
                'password' => bcrypt('123123'),
            ]
        ];

        \DB::table('users')->insert($data);
    }
}
