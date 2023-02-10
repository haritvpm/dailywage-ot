<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSessionDutiesTable extends Migration
{
    public function up()
    {
        Schema::table('session_duties', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_7980588')->references('id')->on('daily_wage_employees');
            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id', 'session_fk_7980592')->references('id')->on('sessions');
            $table->unsignedBigInteger('owned_by_id')->nullable();
            $table->foreign('owned_by_id', 'owned_by_fk_7980640')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7980624')->references('id')->on('users');
        });
    }
}
