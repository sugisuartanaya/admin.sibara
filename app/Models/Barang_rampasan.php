<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_rampasan extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function izin(){
        return $this->hasOne(Izin::class, 'id_barang');
    }

    public function harga_wajar()
    {
        return $this->hasMany(Harga_wajar::class, 'id_barang');
    }

    public function daftar_barang()
    {
        return $this->hasMany(Daftar_barang::class, 'id_barang');
    }

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_barang');
    }

    protected $fillable = [
        'nama_barang',
        'nama_terdakwa',
        'no_putusan',
        'tgl_putusan',
        'kategori_id',
        'deskripsi',
        'foto_thumbnail',
        'foto_barang',
        'status'
    ];
}
