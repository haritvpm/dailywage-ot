<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutyFormsTable extends Migration
{
    public function up()
    {
        Schema::create('duty_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('form_type')->nullable();
            $table->string('creator')->nullable(); //name and desig
            $table->string('approver')->nullable();
            $table->float('total_hours', 10, 2)->nullable();
            $table->integer('form_num')->nullable();
            $table->timestamps();
        });
    }
}
