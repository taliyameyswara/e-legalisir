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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('file_ijazah')->nullable()->constrained('documents')->cascadeOnDelete();
            $table->foreignId('file_transkrip_1')->nullable()->constrained('documents')->cascadeOnDelete();
            $table->foreignId('file_transkrip_2')->nullable()->constrained('documents')->cascadeOnDelete();



            // status transaksi
            // menunggu pembayaran -> belum dibayar
            // proses legalisir -> sudah dibayar
            // pengiriman -> sudah legalisir
            // selesai -> sudah diterima

            $table->string('nama_penerima');
            $table->string('no_hp');
            $table->string('province_id');
            $table->string('city_id');
            $table->string('alamat_pengiriman');
            $table->string('kode_pos');
            $table->string('kurir');
            $table->string('nomor_pengiriman')->nullable();

            $table->enum('status', ['menunggu pembayaran', 'proses legalisir', 'pengiriman', 'selesai'])->default('menunggu pembayaran');
            $table->decimal('biaya_ongkir', 10, 2)->nullable();
            $table->decimal('jumlah_pembayaran', 10, 2)->nullable();
            $table->string('bukti_pembayaran')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
