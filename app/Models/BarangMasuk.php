<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuks';

    protected $fillable = [
        'barang_id',
        'jumlah',
        'tanggal_masuk',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'jumlah' => 'integer',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
