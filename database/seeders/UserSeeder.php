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
        $data = array(
            [
                "name" => "admin",
                "email" => "admin@gmail.com",
                "phone" => "0123456789",
                "password" => bcrypt("12345678"),
            ]
        );
        DB::table("users")->insert($data);
    }
}
