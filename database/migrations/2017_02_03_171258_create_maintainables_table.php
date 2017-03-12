<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintainablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintainables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->longText('desc')->nullable();
            $table->char('maintainable_type',32)->nullable();
            $table->unsignedBigInteger('maintainable_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintainables');
    }
}
