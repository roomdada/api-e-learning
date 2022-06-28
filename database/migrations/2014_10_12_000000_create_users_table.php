<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['M', 'F']);
            $table->string('avatar')->nullable();
            $table->timestamp('latest_logged_at')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('badge')->nullable();
            $table->integer('country_id')->index()->nullable();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
