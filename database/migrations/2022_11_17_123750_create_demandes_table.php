<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ["en_attente","en_cours", "traite", "rejete"]);

            $table->longText('contenu');
            $table->longText('feedback')->nullable();
            $table->string('objet');

            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('users');

            $table->unsignedBigInteger('auteur_id');
            $table->foreign('auteur_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
