<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspekKerja extends Model
{
    protected $table = 'prospek_kerja';

    protected $fillable = ['jurusan_id', 'tipe', 'isi'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
