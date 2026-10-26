<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('barang')
            ->latest()
            ->get();

        return view('barang_masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('barang_masuk.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($data) {
            $barang = Barang::whereKey($data['barang_id'])
                ->lockForUpdate()
                ->firstOrFail();

            BarangMasuk::create($data);

            $barang->increment('stok', $data['jumlah']);
        });

        return redirect()->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil dicatat dan stok bertambah!');
    }
}
