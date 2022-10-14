<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $params = [
            [
                'name' => '新島',
                'email' => 'user@com',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            [
                'name' => '管理者',
                'email' => 'admin@com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
        ];
        DB::table('users')->insert($params);
    }
}
