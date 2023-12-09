<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;
    public function gambarKost()
    {
        return $this->hasMany(GambarKost::class, 'm_id_kost');
    }
}
