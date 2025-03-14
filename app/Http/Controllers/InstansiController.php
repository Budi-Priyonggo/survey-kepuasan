<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instansi = Instansi::paginate(10);
        return view('instansi.index', compact('instansi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255|unique:instansi,nama_instansi',
        ], [
            'nama_instansi.required' => 'Nama instansi wajib diisi!',
            'nama_instansi.unique' => 'Nama instansi sudah ada!',
        ]);

        Instansi::create([
            'nama_instansi' => $request->nama_instansi,
        ]);

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instansi $instansi)
    {
        $hasil = $instansi->hasil()->paginate(10);
        return view('instansi.show', compact('instansi', 'hasil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instansi $instansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'nama_instansi' => [
                'required',
                'string',
                'max:255',
                Rule::unique('instansi')->ignore($instansi->id),
            ],
        ], [
            'nama_instansi.required' => 'Nama instansi wajib diisi!',
            'nama_instansi.unique' => 'Nama instansi sudah ada!',
        ]);

        // Mengupdate data instansi
        $instansi->update([
            'nama_instansi' => $request->nama_instansi,
        ]);

        return redirect()->route('instansi.index')->with('edit', 'Instansi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instansi $instansi)
    {
        $instansi->delete();

        return redirect()->route('instansi.index')->with('delete', 'Instansi berhasil dihapus.');
    }
}
