<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanMinat extends Model
{
    protected $table = 'jawaban_minat';

    protected $fillable = ['tes_id', 'soal_minat_id', 'skor'];

    public function tes()
    {
        return $this->belongsTo(Tes::class);
    }

    public function soal()
    {
        return $this->belongsTo(SoalMinat::class, 'soal_minat_id');
    }
}
