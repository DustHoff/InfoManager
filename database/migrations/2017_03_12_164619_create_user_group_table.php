<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group',function (Blueprint $table){
            $table->bigIncrements("id");
            $table->bigInteger("user_id");
            $table->bigInteger("group_id");
        });
        DB::table('user_group')->insert(["user_id"=>1,"group_id"=>1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_group');
    }
}
