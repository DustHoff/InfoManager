<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePermissionSystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists("permissions");
        Schema::dropIfExists("group_permission");
        Schema::table("groups", function (Blueprint $table) {
            $table->boolean("admin")->default(false);
            $table->boolean("editor")->default(false);
            $table->boolean("schedule")->default(false);
            $table->unique("name");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
