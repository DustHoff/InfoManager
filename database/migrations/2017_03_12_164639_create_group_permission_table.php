<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_permission',function (Blueprint $table){
            $table->bigIncrements("id");
            $table->bigInteger("group_id");
            $table->bigInteger("permission_id");
        });
        DB::table('group_permission')->insert([
            ["group_id"=>1,"permission_id"=>1],
            ["group_id"=>1,"permissionid"=>2]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_permission');
    }
}
