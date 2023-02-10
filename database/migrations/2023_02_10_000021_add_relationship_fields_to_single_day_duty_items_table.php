<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSingleDayDutyItemsTable extends Migration
{
    public function up()
    {
        Schema::table('single_day_duty_items', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_7980645')->references('id')->on('daily_wage_employees');
            $table->unsignedBigInteger('form_id')->nullable();
            $table->foreign('form_id', 'form_fk_7980656')->references('id')->on('single_day_duties');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7980654')->references('id')->on('users');
        });
    }
}
