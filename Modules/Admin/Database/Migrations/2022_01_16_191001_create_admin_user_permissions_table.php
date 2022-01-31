<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->integer('status');
            $table->integer('status');
            $table->string('password', 500);
            $table->integer('status');
            $table->integer('status');
            $table->integer('status');
            $table->dateTime('created_date');
            $table->dateTime('modified_date');
            $table->integer('status');
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
        Schema::dropIfExists('admin_user_permissions');
    }
}
