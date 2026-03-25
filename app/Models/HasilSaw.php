<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilSaw extends Model
{
    protected $table = 'hasil_saw';

    protected $fillable = [
        'tes_id',
        'jurusan_id',
        'nilai_preferensi',
        'peringkat'
    ];

    public function tes()
    {
        return $this->belongsTo(Tes::class, 'tes_id');
    }


    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
