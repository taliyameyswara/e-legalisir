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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nim');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('program_studi');
            $table->string('nomor_sk_rektor');
            $table->string('nomor_ijazah');
            $table->string('file_ijazah')->nullable()->default(null);
            $table->string('file_transkrip_1')->nullable()->default(null);
            $table->string('file_transkrip_2')->nullable()->default(null);
            $table->enum('status', ['pending', 'menunggu pembayaran', 'dibayar', 'proses legalisir', 'selesai'])->default('pending');
            $table->text('alamat_pengiriman')->nullable()->default(null);
            $table->string('kabupaten_kota')->nullable()->default(null);
            $table->string('provinsi')->nullable()->default(null);
            $table->decimal('ongkir', 10, 2)->nullable()->default(null);
            $table->decimal('total_pembayaran', 10, 2)->nullable()->default(null);
            $table->string('bukti_pembayaran')->nullable()->default(null);
            $table->timestamps();

            $table->index(['status', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
