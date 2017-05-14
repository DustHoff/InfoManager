<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char("name", 32)->unique();
            $table->longText("value")->nullable();
            $table->timestamps();
        });

        $option = new \App\Option;
        $option->name = "email_header";
        $option->value = "";
        $option->save();

        $option = new \App\Option;
        $option->name = "email_footer";
        $option->value = "";
        $option->save();

        foreach (\App\Maintenance::TYPE as $type) {
            $option = new \App\Option;
            $option->name = "message_" . $type;
            $option->value = "";
            $option->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
