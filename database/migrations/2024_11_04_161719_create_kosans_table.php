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
        Schema::create('kosans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->string('nama_kosan'); 
            $table->string('alamat_kosan');
            $table->integer('harga_kosan'); 
            $table->integer('kamar_tersedia');
            $table->enum('jenis_kosan', ['Putra', 'Putri','Campur']);
            $table->text('deskripsi_kosan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosans');
    }
};
