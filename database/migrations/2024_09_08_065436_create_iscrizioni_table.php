<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('iscriziones', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->string('socio_cai');
            $table->string('indirizzo')->nullable();
            $table->integer('sezione')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->integer('iscrizione_tipo')->nullable();
            $table->integer('attivita_id')->nullable();
            $table->integer('stato_iscrizione')->default(value: 0)->nullable();
            $table->date('data_nascita')->nullable();
            $table->string('luogo_nascita', 300)->nullable();
            $table->integer('accettazione_termini')->default(value: 0)->nullable();
            $table->integer('accettazione_privacy')->default(value: 0)->nullable();
            $table->string('data_iscrizione')->nullable();
            $table->string('data_cancellazione')->nullable();
            $table->integer('order')->nullable();
            $table->integer('published')->default(value: 1)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iscriziones');
    }
};
