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

    public function transkrip_1()
    {
        return $this->belongsTo(Document::class, 'file_transkrip_1');
    }

    public function transkrip_2()
    {
        return $this->belongsTo(Document::class, 'file_transkrip_2');
    }

    public function r_akta_mengajar()
    {
        return $this->belongsTo(Document::class, 'akta_mengajar');
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
