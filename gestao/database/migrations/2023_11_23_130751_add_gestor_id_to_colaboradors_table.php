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
        Schema::table('colaboradors', function (Blueprint $table) {
            $table->foreignId('gestor_id')->constrained('gestors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('colaboradors', function (Blueprint $table) {
            $table->foreignId('gestor_id')
            ->constrained()
            ->onDelete('cascade');
        });
    }
};
