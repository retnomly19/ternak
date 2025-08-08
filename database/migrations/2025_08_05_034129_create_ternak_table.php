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
        Schema::create('ternak', function (Blueprint $table) {
    $table->string('id_ternak')->primary(); // Misal A001, A002
    $table->string('foto')->nullable();
    $table->string('jenis');
    $table->integer('umur');
    $table->enum('jenis_kelamin', ['jantan', 'betina']);
    $table->integer('harga_beli');
    $table->string('kondisi');
    $table->date('tanggal_masuk');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ternak');
    }
};
