<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;

    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class)
            ->withPivot(['status_pemda', 'status_bkpsdm', 'status_gampong', 'keterangan_gampong', 'keterangan_bkpsdm', 'keterangan_pemda'])
            ->withTimestamps();
    }

    public function satuan_kerja()
    {
        return $this->belongsTo(SatuanKerja::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
