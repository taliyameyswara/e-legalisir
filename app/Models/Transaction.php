<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function ijazah()
    {
        return $this->belongsTo(Document::class, 'file_ijazah');
    }

    public function transkrip()
    {
        return $this->belongsTo(Document::class, 'file_transkrip');
    }


    public function akta()
    {
        return $this->belongsTo(Document::class, 'file_akta');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
