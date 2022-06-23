<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanKerja extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'satuan_kerjas';
    protected $fillable = ['kouta', 'nama_kepala', 'jumlah_bulan'];
}
