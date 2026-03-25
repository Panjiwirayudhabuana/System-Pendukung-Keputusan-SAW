<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'sekolah_asal',
        'jenis_kelamin',
        'no_telepon',
        'alamat',
    ];

    // timestamps default true, cocok migration

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // user_id -> users.id
    }

    public function tes()
    {
        return $this->hasMany(Tes::class, 'siswa_id'); // siswa_id di tes -> siswa.id
    }
}
