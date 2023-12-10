<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function barang_rampasan(){
        return $this->belongsTo(Barang_rampasan::class, 'id_barang');
    }

    protected $fillable = [
        'no_sk',
        'tgl_sk',
        'id_barang'
    ];
}
