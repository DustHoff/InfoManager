<?php

use App\Option;
use Illuminate\Database\Migrations\Migration;

class AddUserOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $option = new Option;
        $option->name = "message_changePassword";
        $option->value = "";
        $option->save();

        $option = new Option;
        $option->name = "message_administrateUser";
        $option->value = "";
        $option->save();
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
