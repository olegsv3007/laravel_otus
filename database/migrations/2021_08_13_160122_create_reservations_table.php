<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('apartment_id');
            $table->timestamps();
            $table->date('date_start');
            $table->date('date_end');
            $table->decimal('price');
            $table->unsignedBigInteger('status_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
