<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user_invites', function (Blueprint $table) {
            $table->id();
            $table->string('names', 150);
            $table->string('email', 255);
            $table->string('password', 500);
            $table->string('account_type', 100);
            $table->text('message');
            $table->integer('status');
            $table->integer('is_blocked');
            $table->dateTime('created_date');
            $table->dateTime('approved_date');
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
        Schema::dropIfExists('admin_user_invites');
    }
}
