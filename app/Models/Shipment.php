<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    // Mendefinisikan tabel yang digunakan oleh model
    protected $table = 'shipments';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'document_id',
        'courier',
        'tracking_number',
        'status',
    ];

    // Relasi dengan Document
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
