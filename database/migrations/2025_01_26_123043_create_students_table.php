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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('sarjana')->nullable();

            $table->string('nomor_ijazah')->nullable();
            $table->string('no_hp')->nullable();
            $table->foreignId('province_id')->nullable()->constrained('provinces');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->string('alamat_pengiriman')->nullable();
            $table->string('kode_pos')->nullable();

            $table->string('nama_perusahaan')->nullable();
            $table->string('jabatan_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->integer('gaji')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
