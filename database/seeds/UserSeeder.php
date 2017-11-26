<?php

use App\User;
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
        $user = new User;
        $user->name = "Administrator";
        $user->username = "admin";
        $user->password = "secure";
        $user->save();
        $group = \App\Group::find(1);
        $user->groups()->attach($group->id);
    }
}
