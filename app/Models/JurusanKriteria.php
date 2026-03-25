<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurusanKriteria extends Model
{
    protected $table = 'jurusan_kriteria';

    protected $fillable = [
        'jurusan_id',
        'kriteria_id',
        'bobot',
        'nilai_min',
        'nilai_max',
        'wajib_lolos',
        'keterangan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}