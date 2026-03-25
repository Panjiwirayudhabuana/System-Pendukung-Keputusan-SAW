<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';

    protected $fillable = [
        'user_id',
        'otp_code',
        'expires_at',
        'is_used'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
