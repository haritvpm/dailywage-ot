<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('duty_form_items', function (Blueprint $table) {
            $table->string('all_ot_hours')->nullable();
            $table->string('all_ot_dayids')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('duty_form_items', function (Blueprint $table) {
            //
        });
    }
};
