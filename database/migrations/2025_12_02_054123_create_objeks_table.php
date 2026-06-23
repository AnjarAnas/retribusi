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
        Schema::create('objeks', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('nama', 100);
            $table->integer('tipe_id');
            $table->integer('kategori_id');
            $table->integer('user_id');
            $table->string('acak1', 30);
            $table->string('acak2', 30);
            $table->string('acak3', 30);
            $table->string('kode', 100);
            $table->string('nama_pemilik', 100);
            $table->integer('luas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objeks');
    }
};
