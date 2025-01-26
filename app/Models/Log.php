<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    // Mendefinisikan tabel yang digunakan oleh model
    protected $table = 'logs';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'document_id',
        'admin_id',
        'action',
        'status',
    ];

    // Relasi dengan Document
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    // Relasi dengan User (admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
