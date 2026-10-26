<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $mulai = $request->tanggal_mulai;
        $selesai = $request->tanggal_selesai;

        // Data barang dan statistik stok
        $barangs = Barang::orderBy('nama_barang')->get();

        $totalJenisBarang = $barangs->count();
        $totalStok = $barangs->sum('stok');

        $stokSehat = $barangs->filter(fn ($barang) => $barang->stok > 5)->count();
        $stokMenipis = $barangs->filter(fn ($barang) => $barang->stok > 0 && $barang->stok <= 5)->count();
        $stokHabis = $barangs->filter(fn ($barang) => $barang->stok <= 0)->count();

        // Ambil transaksi dengan filter tanggal
        $barangMasuks = BarangMasuk::with('barang')
            ->when($mulai, fn ($query) => $query->whereDate('tanggal_masuk', '>=', $mulai))
            ->when($selesai, fn ($query) => $query->whereDate('tanggal_masuk', '<=', $selesai))
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $barangKeluars = BarangKeluar::with('barang')
            ->when($mulai, fn ($query) => $query->whereDate('tanggal_keluar', '>=', $mulai))
            ->when($selesai, fn ($query) => $query->whereDate('tanggal_keluar', '<=', $selesai))
            ->orderBy('tanggal_keluar', 'desc')
            ->get();

        // Total unit transaksi sesuai filter
        $totalBarangMasuk = $barangMasuks->sum('jumlah');
        $totalBarangKeluar = $barangKeluars->sum('jumlah');

        // Data grafik bulanan
        $namaBulan = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        $grafikMasuk = array_fill(0, 12, 0);
        $grafikKeluar = array_fill(0, 12, 0);

        foreach ($barangMasuks as $transaksi) {
            $bulan = Carbon::parse($transaksi->tanggal_masuk)->month - 1;
            $grafikMasuk[$bulan] += (int) $transaksi->jumlah;
        }

        foreach ($barangKeluars as $transaksi) {
            $bulan = Carbon::parse($transaksi->tanggal_keluar)->month - 1;
            $grafikKeluar[$bulan] += (int) $transaksi->jumlah;
        }

        return view('laporan.index', compact(
            'barangs',
            'barangMasuks',
            'barangKeluars',
            'mulai',
            'selesai',
            'totalJenisBarang',
            'totalStok',
            'stokSehat',
            'stokMenipis',
            'stokHabis',
            'totalBarangMasuk',
            'totalBarangKeluar',
            'namaBulan',
            'grafikMasuk',
            'grafikKeluar'
        ));
    }
}
