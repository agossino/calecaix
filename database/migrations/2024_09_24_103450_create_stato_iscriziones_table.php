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
        Schema::create('stato_iscriziones', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->integer('stato_iscrizione')->default(1)->nullable();
            $table->string('nome')->nullable();
            $table->integer('order')->nullable();
            $table->integer('published')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stato_iscriziones');
    }
};
