<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSessionDutyItemsTable extends Migration
{
    public function up()
    {
        Schema::table('session_duty_items', function (Blueprint $table) {
            $table->unsignedBigInteger('date_id')->nullable();
            $table->foreign('date_id', 'date_fk_7980583')->references('id')->on('calenders');
            $table->unsignedBigInteger('form_id')->nullable();
            $table->foreign('form_id', 'form_fk_7980643')->references('id')->on('session_duties');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7980622')->references('id')->on('users');
        });
    }
}
