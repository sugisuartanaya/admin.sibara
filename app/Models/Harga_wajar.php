<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga_wajar extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function barang_rampasan()
    {
        return $this->belongsTo(Barang_rampasan::class, 'id_barang');
    }

    protected $fillable = [
        'no_laporan_penilaian',
        'tgl_laporan_penilaian',
        'harga',
        'id_barang'
    ];
}
