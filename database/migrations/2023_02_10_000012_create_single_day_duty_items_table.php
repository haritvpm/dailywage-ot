<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleDayDutyItemsTable extends Migration
{
    public function up()
    {
        Schema::create('single_day_duty_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('fn_from')->nullable();
            $table->time('fn_to')->nullable();
            $table->time('an_from')->nullable();
            $table->time('an_to')->nullable();
            $table->float('total_hours', 10, 2)->nullable();
            $table->timestamps();
        });
    }
}
