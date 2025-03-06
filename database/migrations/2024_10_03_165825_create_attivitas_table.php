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
        Schema::create('attivitas', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_volantino')->nullable();
            $table->string('socio')->nullable();
            $table->string('tipo_attivita')->nullable();
            $table->string('tipo_iscrizione')->nullable();

            $table->string('titolo', 300)->nullable();
            $table->longText('descrizione')->nullable();
            $table->text('note')->nullable();
            $table->string('numerominimo')->nullable();
            $table->string('numeromassimo')->nullable();

            $table->string('nome')->nullable();
            $table->string('cognome')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('qualifica')->nullable();
            $table->string('specializzazione')->nullable();

            $table->date('data_inizio')->nullable();
            $table->date('data_fine')->nullable();
            $table->integer('calendario')->nullable()->default(0);
            $table->date('inizio_iscrizioni')->nullable();
            $table->date('fine_iscrizioni')->nullable();
            $table->string('luogoritrovo')->nullable();
            $table->string('oraritrovo')->nullable();
            $table->string('tipologiatrasporto')->nullable();

            $table->string('difficolta')->nullable();
            $table->string('lunghezza')->nullable();
            $table->string('dislivello')->nullable();
            $table->string('durata')->nullable();
            $table->string('quotaminima')->nullable();
            $table->string('quotamassima')->nullable();
            $table->string('a_spinta')->nullable();
            $table->string('portage')->nullable();

            $table->string('image_file')->nullable();

            $table->string('pdf_file')->nullable();
            $table->text('link_volantino')->nullable();

            $table->string('email_user')->nullable();
            $table->text('presentazione')->nullable();
            $table->string('data_presentazione')->nullable();
            $table->string('contatti')->nullable();
            $table->string('altro')->nullable();
            $table->string('altriorganizzatori')->nullable();
            $table->string('altricosti')->nullable();
            $table->string('linkluogo')->nullable();
            $table->string('link_modulo_esterno')->nullable();
            $table->string('user_email')->nullable();

            $table->integer('clic')->nullable()->default(0);
            $table->integer('order')->nullable();
            $table->integer('published')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attivitas');
    }
};
