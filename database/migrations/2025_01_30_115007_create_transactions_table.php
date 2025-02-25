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
            $table->foreignId('province_id')->nullable()->constrained('provinces');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->string('alamat_pengiriman')->nullable();
            $table->string('kode_pos')->nullable();
            // $table->string('kurir');
            $table->string('nomor_pengiriman')->nullable();
            $table->integer('jumlah_legalisir')->default(1);
            $table->enum('status', ['menunggu pembayaran', 'menunggu acc', 'proses legalisir', 'pengiriman', 'selesai'])->default('menunggu acc');
            // $table->decimal('biaya_ongkir', 10, 2)->nullable();
            $table->decimal('jumlah_pembayaran', 10, 2)->nullable();
            $table->string('bukti_pembayaran')->nullable();

            $table->enum('tipe_pengiriman', ['cod', 'ambil-kampus'])->default('cod');
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
