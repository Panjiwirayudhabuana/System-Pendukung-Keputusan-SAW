<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
     protected $table = 'uploads';

    protected $fillable = [
        'uploader_user_id',
        'file_name',
        'ext',
        'mime_type',
        'size_mb',
        'storage_path'
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_user_id');
    }
}
