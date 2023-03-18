<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('longtitle')->unique();
            $table->float('max_hours', 4, 2);
            $table->time('working_fn_from')->nullable();
            $table->time('working_fn_to')->nullable();
            $table->time('working_an_from')->nullable();
            $table->time('working_an_to')->nullable();
            $table->timestamps();
        });
    }
}
