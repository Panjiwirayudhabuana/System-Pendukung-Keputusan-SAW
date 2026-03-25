<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $fillable = [
        'nama_jurusan',
        'is_active',
    ];

    public function guruBk()
    {
        return $this->hasMany(GuruBk::class);
    }

    public function jurusanKriteria()
    {
        return $this->hasMany(JurusanKriteria::class);
    }

    public function informasiJurusan()
    {
        return $this->hasOne(InformasiJurusan::class);
    }

    public function prospekKerja()
    {
        return $this->hasMany(ProspekKerja::class);
    }

    public function artikelJurusan()
    {
        return $this->hasMany(ArtikelJurusan::class);
    }
}