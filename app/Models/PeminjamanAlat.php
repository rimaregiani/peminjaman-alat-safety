<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanAlat extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_alat';

    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah',
        'tgl_pinjam',
        'tgl_kembali',
        'foto_serah_terima',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function alat(){
        return $this->belongsTo(AlatSafety::class,'alat_id');
    }
}
