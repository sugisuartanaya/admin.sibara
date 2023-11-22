<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'user_id',
        'nama_pegawai',
        'nip',
        'pangkat',
        'jabatan',
        'foto_pegawai',
        'is_admin',
    ];

    
}
