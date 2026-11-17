<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();

            // Data pelanggan
            $table->string('nama', 100);
            $table->string('telepon', 20);
            $table->string('alamat');

            // Data layanan
            $table->string('nama_layanan', 100);
            $table->text('detail');

            // Foto sofa (maksimal 5 foto dalam bentuk JSON)
            $table->json('gambar')->nullable();

            // Status permintaan layanan
            $table->string('status')->default('Menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
