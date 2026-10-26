<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluars = BarangKeluar::with('barang')
            ->latest()
            ->get();

        return view('barang_keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('barang_keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($data) {
            $barang = Barang::whereKey($data['barang_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($barang->stok < $data['jumlah']) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Jumlah barang keluar melebihi stok yang tersedia.',
                ]);
            }

            BarangKeluar::create($data);

            $barang->decrement('stok', $data['jumlah']);
        });

        return redirect()->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil dicatat dan stok berkurang!');
    }
}
