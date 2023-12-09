<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrakan extends Model
{
    use HasFactory;
    public function gambarKontrakan()
    {
        return $this->hasMany(GambarKontrakan::class, 'm_id_kontrakan');
    }
}
