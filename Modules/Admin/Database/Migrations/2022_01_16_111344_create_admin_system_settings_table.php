<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_system_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('gold_user_limit');
            $table->integer('platinum_user_limit');
            $table->string('topagent_limit', 255);
            $table->integer('topagent_limit_days');
            $table->string('agent_commission', 255);
            $table->string('university_commission', 30);
            $table->string('gst', 255);
            $table->integer('cutoff_date_invoice');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
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
        Schema::dropIfExists('admin_system_settings');
    }
}
