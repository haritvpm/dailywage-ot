<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDutyFormItemsTable extends Migration
{
    public function up()
    {
        Schema::table('duty_form_items', function (Blueprint $table) {
            $table->unsignedBigInteger('form_id')->nullable();
            $table->foreign('form_id', 'form_fk_8011901')->references('id')->on('duty_forms');
            $table->unsignedBigInteger('date_id')->nullable();
            $table->foreign('date_id', 'date_fk_8011902')->references('id')->on('calenders');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_8011903')->references('id')->on('daily_wage_employees');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8011912')->references('id')->on('users');
        });
    }
}
