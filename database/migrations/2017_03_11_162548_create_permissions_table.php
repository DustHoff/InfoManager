<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char("name");
            $table->char("permission");
        });
        DB::table('permissions')->insert([
            [
                "name" => "Schedule Maintenance",
                "permission" => \App\Http\Requests\MaintenanceRequest::class
            ], [
                "name" => "create/edit Systems",
                "permission" => \App\Http\Requests\MaintainableRequest::class
            ], [
                "name" => "create/edit Groups",
                "permission" => \App\Http\Requests\GroupRequest::class
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
