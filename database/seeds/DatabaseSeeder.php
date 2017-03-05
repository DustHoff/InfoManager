<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(HostSeeder::class);
        //$this->call(ApplicationSeeder::class);
        $this->call(UserSeeder::class);
    }
}
