<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $param = [
            'status' => TRUE,
            'login_id' => 'niijima2001',
            'name' => '新島駿',
            'email' => 'niijima131229@docomo.ne.jp',
            'password' => 'shun1229',
        ];

        DB::table('users')->insert($param);
    }
}
