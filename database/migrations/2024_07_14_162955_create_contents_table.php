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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->integer('catid')->nullable()->default(1);
            $table->integer('condizioni')->nullable()->default(1);
            $table->string('titolo',300)->nullable();
            $table->string('alias',300)->nullable();
            $table->string('note',300)->nullable();
            $table->text('images')->nullable();
            $table->text('fulltext')->nullable();
            $table->text('introtext')->nullable();
            $table->integer('state')->nullable()->default(1);
            $table->integer('published')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
