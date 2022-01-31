<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsergroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_usergroup', function (Blueprint $table) {
            $table->id();
            $table->string('usergroup_name', 150);
            $table->integer('status');
            $table->dateTime('created_datetime');
            $table->dateTime('modified_datetime');
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
        Schema::dropIfExists('admin_usergroup');
    }
}
