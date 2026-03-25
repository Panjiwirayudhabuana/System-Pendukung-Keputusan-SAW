<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'role_id',
        'nama',
        'email',
        'password_hash',
        'is_active',
        'must_change_password',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'must_change_password' => 'boolean',
    ];

    // Laravel Auth default cari kolom "password", jadi diarahkan ke "password_hash"
    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    public function guruBk()
    {
        return $this->hasOne(GuruBk::class, 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function isGuruBk(): bool
    {
        return optional($this->role)->nama_role === 'guru_bk';
    }

    public function isSiswa(): bool
    {
        return optional($this->role)->nama_role === 'siswa';
    }

    public function isAdmin(): bool
    {
        return optional($this->role)->nama_role === 'admin';
    }

    public function isGuruBkProfileIncomplete(): bool
    {
        if (!$this->isGuruBk()) {
            return false;
        }

        $guruBk = $this->guruBk;

        if (!$guruBk) {
            return true;
        }

        return blank($guruBk->nip);
    }
}