<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::latest()->get();

        return view('distributor.index', compact('distributors'));
    }

    public function create()
    {
        return view('distributor.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_distributor' => 'required|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Distributor::create($data);

        return redirect()->route('distributor.index')
            ->with('success', 'Distributor berhasil ditambahkan!');
    }

    public function edit(Distributor $distributor)
    {
        return view('distributor.edit', compact('distributor'));
    }

    public function update(Request $request, Distributor $distributor)
    {
        $data = $request->validate([
            'nama_distributor' => 'required|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $distributor->update($data);

        return redirect()->route('distributor.index')
            ->with('success', 'Distributor berhasil diperbarui!');
    }

    public function destroy(Distributor $distributor)
    {
        $distributor->delete();

        return redirect()->route('distributor.index')
            ->with('success', 'Distributor berhasil dihapus!');
    }
}
