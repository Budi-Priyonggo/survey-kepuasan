<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $guarded = ['id'];

    public function hasil()
    {
        return $this->hasMany(hasil::class);
    }
}
