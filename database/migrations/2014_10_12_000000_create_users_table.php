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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
<<<<<<< HEAD
            $table->enum('role',['super-admin','client','admin'])->default('client');
=======
<<<<<<< HEAD
            $table->enum('role',['client','admin','super-admin'])->default('client');
=======
            $table->enum('role',['client','admin','super-admin']);
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
>>>>>>> 55eecffa7e44b946ac5fa007165d181af020a851
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
