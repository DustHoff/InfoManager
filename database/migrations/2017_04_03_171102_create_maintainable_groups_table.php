<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintainableGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintainablegroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char("name", 32);
            $table->timestamps();
        });
        Schema::create('maintainable_maintainablegroup', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("maintainable_id");
            $table->bigInteger("maintainable_group_id");
        });
        Schema::create("maintainablegroup_group", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("group_id");
            $table->bigInteger("maintainable_group_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintainablegroups');
        Schema::dropIfExists('maintainable_maintainablegroup');
        Schema::dropIfExists('maintainablegroup_group');
    }
}
