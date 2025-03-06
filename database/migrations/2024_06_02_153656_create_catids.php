<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TipoAttivita content
     */
    public function up(): void
    {
        Schema::create('catids', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->primary();
            $table->integer('categoria')->nullable();
            $table->string('nome')->nullable();
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
        Schema::dropIfExists('catids');
    }
};
