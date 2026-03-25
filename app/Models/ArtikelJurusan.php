<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ArtikelJurusan extends Model
{
    protected $table    = 'artikel_jurusan';
    protected $fillable = [
        'jurusan_id', 'judul', 'deskripsi',
        'file_upload_id', 'gambar_upload_id', 'created_by_user_id',
    ];

    public function jurusan()      { return $this->belongsTo(Jurusan::class); }
    public function creator()      { return $this->belongsTo(User::class, 'created_by_user_id'); }
    public function fileUpload()   { return $this->belongsTo(Upload::class, 'file_upload_id'); }
    public function gambarUpload() { return $this->belongsTo(Upload::class, 'gambar_upload_id'); }
}