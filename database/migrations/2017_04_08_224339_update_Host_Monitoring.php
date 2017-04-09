<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHostMonitoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("monitoringhosts",function (Blueprint $table){
            $table->char("identifier",64)->primary();
            $table->bigInteger("host_id");
        });

        foreach (\App\Host::all() as $host){
            if($host->zabbix_id==-1) continue;
            $monitoringHost = new \App\Monitoring\MonitoringHost;
            $monitoringHost->identifier = $host->zabbix_id;
            $monitoringHost->host_id = $host->id;
        }
        Schema::table("hosts",function (Blueprint $table){
            $table->dropColumn("zabbix_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("monitoringhosts");
    }
}
