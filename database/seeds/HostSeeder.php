<?php

use Illuminate\Database\Seeder;

class HostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maintainables')->insert(array(
            'maintainable_type' => 'Host',
            'maintainable_id'=> 1,
            'name'=> 'localhost'
        ));
        DB::table('hosts')->insert(array(
            'stage' => \App\Host::STAGE[0],
            'owner' => "Dustin Hoffmann",
            'zabbix_id' => 1
        ));
    }
}
