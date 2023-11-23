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
        Schema::table('gestors', function (Blueprint $table) {
            $table->foreignId('contato_id')->constrained('contatos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gestors', function (Blueprint $table) {
            $table->foreignId('contato_id')
            ->constrained()
            ->onDelete('cascade');
        });
    }
};
