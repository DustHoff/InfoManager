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
        DB::table("groups")->where("id", 1)->update(["admin" => 1, "editor" => 1, "schedule" => 1]);
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
