<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group;
        $group->name = "Administrator";
        $group->admin = true;
        $group->save();
    }
}
