<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSingleDayDutiesTable extends Migration
{
    public function up()
    {
        Schema::table('single_day_duties', function (Blueprint $table) {
            $table->unsignedBigInteger('date_id')->nullable();
            $table->foreign('date_id', 'date_fk_7980628')->references('id')->on('calenders');
            $table->unsignedBigInteger('owned_by_id')->nullable();
            $table->foreign('owned_by_id', 'owned_by_fk_7980641')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7980638')->references('id')->on('users');
        });
    }
}
