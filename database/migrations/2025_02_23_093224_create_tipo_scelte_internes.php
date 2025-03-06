<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_scelte_internes', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->integer('tipo_scelte')->nullable();
            $table->string('scelta')->nullable();
            $table->string('descrizione')->nullable();
            $table->integer('order')->nullable();
            $table->tinyInteger('published')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_scelte_internes');
    }
};
