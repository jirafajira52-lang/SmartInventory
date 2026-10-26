<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Distributor;
use App\Models\Agen;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        $totalBarang = $barangs->count();
        $totalStok = $barangs->sum('stok');
        $totalSupplier = Supplier::count();
        $totalDistributor = Distributor::count();
        $totalAgen = Agen::count();

        $stokSehat = $barangs->filter(fn ($b) => $b->stok > 5)->count();
        $stokMenipis = $barangs->filter(fn ($b) => $b->stok > 0 && $b->stok <= 5)->count();
        $stokHabis = $barangs->filter(fn ($b) => $b->stok <= 0)->count();

        $namaBulan = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        $grafikMasuk = [];
        $grafikKeluar = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $grafikMasuk[] = (int) BarangMasuk::whereYear(
                'tanggal_masuk', now()->year
            )->whereMonth('tanggal_masuk', $bulan)->sum('jumlah');

            $grafikKeluar[] = (int) BarangKeluar::whereYear(
                'tanggal_keluar', now()->year
            )->whereMonth('tanggal_keluar', $bulan)->sum('jumlah');
        }

        $totalBarangMasuk = BarangMasuk::sum('jumlah');
        $totalBarangKeluar = BarangKeluar::sum('jumlah');

        return view('dashboard', compact(
            'barangs',
            'totalBarang',
            'totalStok',
            'totalSupplier',
            'totalDistributor',
            'totalAgen',
            'stokSehat',
            'stokMenipis',
            'stokHabis',
            'namaBulan',
            'grafikMasuk',
            'grafikKeluar',
            'totalBarangMasuk',
            'totalBarangKeluar'
        ));
    }
}
