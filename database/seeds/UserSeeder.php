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
        \Illuminate\Support\Facades\DB::table("users")->insert([
            "name"=>"Admin",
            "password"=>Hash::make("LMis0815"),
        ]);
    }
}
