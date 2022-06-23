<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    public function satuan_kerja()
    {
        return $this->belongsTo(SatuanKerja::class);
    }
}
