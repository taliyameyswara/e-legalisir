<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Mendefinisikan tabel yang digunakan oleh model
    protected $table = 'payments';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'document_id',
        'amount',
        'status',
        'payment_method',
        'payment_proof',
    ];

    // Relasi dengan Document
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
