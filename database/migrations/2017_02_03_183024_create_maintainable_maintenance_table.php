<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintainableMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintainable_maintenance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('maintainable_id')->index();
            $table->unsignedBigInteger('maintenance_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintainable_maintenance');
    }
}
