<?php

namespace App\Http\Controllers;

use App\Models\Agen;
use Illuminate\Http\Request;

class AgenController extends Controller
{
    public function index()
    {
        $agens = Agen::latest()->get();

        return view('agen.index', compact('agens'));
    }

    public function create()
    {
        return view('agen.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_agen' => 'required|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        Agen::create($data);

        return redirect()->route('agen.index')
            ->with('success', 'Data agen berhasil ditambahkan!');
    }

    public function edit(Agen $agen)
    {
        return view('agen.edit', compact('agen'));
    }

    public function update(Request $request, Agen $agen)
    {
        $data = $request->validate([
            'nama_agen' => 'required|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        $agen->update($data);

        return redirect()->route('agen.index')
            ->with('success', 'Data agen berhasil diperbarui!');
    }

    public function destroy(Agen $agen)
    {
        $agen->delete();

        return redirect()->route('agen.index')
            ->with('success', 'Data agen berhasil dihapus!');
    }
}
