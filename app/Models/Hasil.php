<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'hasil';
    protected $guarded = ['id'];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }
}
