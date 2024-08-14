<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
         $seedDatas = [
            [
                'name' => 'test',
                'email' => 'test@test',
                'password' => Hash::make('testtest'),
                'is_reader' => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test',
                'password' => Hash::make('testtest'),
                'is_reader' => false,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ];
        foreach ($seedDatas as $data) {
            DB::table('users')->insert($data);
        }
    }
}
