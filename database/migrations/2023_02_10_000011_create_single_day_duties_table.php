<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleDayDutiesTable extends Migration
{
    public function up()
    {
        Schema::create('single_day_duties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('total_hours', 10, 2)->nullable();
            $table->string('section_name')->nullable();
            $table->timestamps();
        });
    }
}
