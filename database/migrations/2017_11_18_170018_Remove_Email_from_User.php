<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveEmailFromUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users", function (Blueprint $table) {
            $table->renameColumn("email", "email_bck")->nullable();
        });
        Schema::table("users", function (Blueprint $table) {
            $table->bigInteger("email_id")->nullable();
        });
        $users = \App\User::all();
        foreach ($users as $user) {
            $email = \App\Email::query()->firstOrCreate(["email" => $user->email_bck]);
            $user->email()->associate($email);
            $user->save();
        }
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn("email_bck");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("users", function (Blueprint $table) {
            $table->char("email_bck")->nullable();
        });
        $users = \App\User::all();
        foreach ($users as $user) {
            $user->email_bck = (isset($user->email_id)) ? $user->email->email : '';
            $user->save();
        }
        Schema::table("users", function (Blueprint $table) {
            $table->renameColumn("email_bck", "email");
        });
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn("email_id");
        });
    }
}
