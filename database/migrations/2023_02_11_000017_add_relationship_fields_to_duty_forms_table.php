<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDutyFormsTable extends Migration
{
    public function up()
    {
        Schema::table('duty_forms', function (Blueprint $table) {
            $table->unsignedBigInteger('date_id')->nullable();
            $table->foreign('date_id', 'date_fk_8011882')->references('id')->on('calenders');
            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id', 'session_fk_8011883')->references('id')->on('sessions');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_8011884')->references('id')->on('daily_wage_employees');
            $table->unsignedBigInteger('owned_by_id')->nullable();
            $table->foreign('owned_by_id', 'owned_by_fk_8011887')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8011891')->references('id')->on('users');
        //    $table->unsignedBigInteger('submitted_by_id')->nullable();
         //   $table->foreign('submitted_by_id', 'submitted_by_fk_8011891')->references('id')->on('users');
        });
    }
}
