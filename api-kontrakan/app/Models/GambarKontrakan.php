<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarKontrakan extends Model
{
    use HasFactory;
    public function kontrakan(){
        return $this->belongsTo(Kontrakan::class,'m_id_kontrakan');
    }
}
