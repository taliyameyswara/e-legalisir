<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'tanggal_lahir',
        'tempat_lahir',
        'program_studi',
        'nomor_sk_rektor',
        'nomor_ijazah',
        'file_ijazah',
        'file_transkrip_1',
        'file_transkrip_2',
        'status',
        'alamat_pengiriman',
        'kabupaten_kota',
        'provinsi',
        'ongkir',
        'total_pembayaran',
        'bukti_pembayaran',
    ];

    // Relasi dengan User (mahasiswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Relasi dengan Shipment
    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

    // Relasi dengan Log
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
