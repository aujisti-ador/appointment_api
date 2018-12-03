<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->integer('guest_id')->unsigned()->nullable()->change();
            $table->string('note')->default('please give me an appointment!')->nullable()->change();
            $table->text('location')->nullable()->change();
            $table->integer('appointment_status_id')->unsigned()->default(2)->nullable()->change();
            $table->integer('assistant_id')->unsigned()->nullable()->change();
            $table->dropColumn('status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
