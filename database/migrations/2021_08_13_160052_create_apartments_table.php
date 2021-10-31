<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->boolean('active');
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedSmallInteger('number_of_people');
            $table->string('title');
            $table->text('description');
            $table->float('price');
            $table->unsignedSmallInteger('discount')->default(0);
            $table->string('main_image');

            $table->softDeletes();

            $table->foreign('hotel_id')
                ->references('id')
                ->on('hotels')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
