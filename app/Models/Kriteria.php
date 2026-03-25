<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'atribut',
        'is_active',
    ];

    public function jurusanKriteria()
    {
        return $this->hasMany(JurusanKriteria::class);
    }
}