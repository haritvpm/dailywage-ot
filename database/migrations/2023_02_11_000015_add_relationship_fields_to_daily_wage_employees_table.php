<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDailyWageEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('daily_wage_employees', function (Blueprint $table) {
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id', 'designation_fk_8011773')->references('id')->on('designations');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_8011772')->references('id')->on('categories');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id', 'section_fk_8011774')->references('id')->on('sections');
        });
    }
}
