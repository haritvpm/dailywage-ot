<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutyFormItemsTable extends Migration
{
    public function up()
    {
        Schema::create('duty_form_items', function (Blueprint $table) {
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
