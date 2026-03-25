<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TesPdf extends Model
{
    protected $table = 'tes_pdf';
    protected $primaryKey = 'tes_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['tes_id', 'upload_id', 'generated_at'];

    public function upload()
    {
        return $this->belongsTo(Upload::class, 'upload_id');
    }

    public function tes()
    {
        return $this->belongsTo(Tes::class, 'tes_id');
    }
}
