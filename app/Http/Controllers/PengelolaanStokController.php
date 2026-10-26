<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class PengelolaanStokController extends Controller
{
    public function index()
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        $totalBarang = $barangs->count();

        $stokMenipis = $barangs->filter(function ($barang) {
            return $barang->stok > 0 && $barang->stok <= 5;
        })->count();

        $stokHabis = $barangs->filter(function ($barang) {
            return $barang->stok <= 0;
        })->count();

        return view('pengelolaan_stok.index', compact(
            'barangs',
            'totalBarang',
            'stokMenipis',
            'stokHabis'
        ));
    }
}
