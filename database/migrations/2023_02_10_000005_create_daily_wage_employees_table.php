<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyWageEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('daily_wage_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('ten')->unique();
            $table->timestamps();
        });
    }
}
