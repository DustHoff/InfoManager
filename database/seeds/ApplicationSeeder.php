<?php

use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maintainables')->insert(array(
            'maintainable_type' => 'Application',
            'maintainable_id'=> 1,
            'name'=> 'Infomanager'
        ));
        DB::table('applications')->insert(array('host_id'=>1));
    }
}
