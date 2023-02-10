<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionDutiesTable extends Migration
{
    public function up()
    {
        Schema::create('session_duties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section_name')->nullable();
            $table->timestamps();
        });
    }
}
