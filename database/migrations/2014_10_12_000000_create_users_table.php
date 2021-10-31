<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token')->unique()->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
