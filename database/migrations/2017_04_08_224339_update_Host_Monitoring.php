<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHostMonitoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("hosts",function (Blueprint $table){
            $table->dropColumn("zabbix_id");
        });
        Schema::table("maintainables", function (Blueprint $table) {
            $table->char("monitoring_id", 32)->nullable();
        });
        Schema::table("maintenances", function (Blueprint $table) {
            $table->char("monitoring_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
