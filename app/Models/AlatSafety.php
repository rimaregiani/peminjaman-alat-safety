<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatSafety extends Model
{
    use HasFactory;

    protected $table = 'alat_safety'; // optional, tapi biar jelas

    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'category_id',
        'stok',
        'lokasi',
        'keterangan',
        'foto'
    ];


    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
