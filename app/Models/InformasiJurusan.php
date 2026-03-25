<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InformasiJurusan extends Model
{
    protected $table        = 'informasi_jurusan';
    protected $primaryKey   = 'jurusan_id';
    public    $incrementing = false;
    protected $fillable     = ['jurusan_id', 'fasilitas', 'updated_by_user_id'];

    public function jurusan()   { return $this->belongsTo(Jurusan::class); }
    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by_user_id'); }
}