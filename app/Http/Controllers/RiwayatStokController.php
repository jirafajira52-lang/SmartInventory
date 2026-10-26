<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class RiwayatStokController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('barang')
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => $item->tanggal_masuk,
                    'nama_barang' => $item->barang?->nama_barang ?? 'Barang tidak ditemukan',
                    'jenis' => 'Barang Masuk',
                    'jumlah' => $item->jumlah,
                    'keterangan' => $item->keterangan ?? '-',
                ];
            });

        $barangKeluars = BarangKeluar::with('barang')
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => $item->tanggal_keluar,
                    'nama_barang' => $item->barang?->nama_barang ?? 'Barang tidak ditemukan',
                    'jenis' => 'Barang Keluar',
                    'jumlah' => $item->jumlah,
                    'keterangan' => $item->keterangan ?? '-',
                ];
            });

        $riwayat = $barangMasuks
            ->concat($barangKeluars)
            ->sortByDesc('tanggal')
            ->values();

        return view('riwayat_stok.index', compact('riwayat'));
    }
}
