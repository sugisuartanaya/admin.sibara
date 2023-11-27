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

    protected $fillable = [
        'nama_barang',
        'no_putusan',
        'kategori_id',
        'deskripsi',
        'foto_thumbnail',
        'foto_barang',
    ];
}
