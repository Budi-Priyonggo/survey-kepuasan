<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Instansi;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasil = Hasil::all();
        $instansi = Instansi::all();
        return view('hasil.index', compact('hasil', 'instansi'));
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
        $validated = $request->validate([
            'kepuasan' => 'required|string',
            'pungutan' => 'required|string',
            'saran' => 'nullable|string|max:100',
            'instansi_id' => 'required|exists:instansi,id',
        ], [
            'kepuasan.required' => 'Kolom kepuasan wajib diisi!',
            'pungutan.required' => 'Kolom pungutan wajib diisi!',
            'instansi_id.required' => 'Kolom instansi wajib diisi!',
            'saran.max' => 'Tidak boleh lebih dari 100 karakter!',
        ]);

        $saran = str_replace(' ', '', $request->input('saran'));

        Hasil::create([
            'kepuasan' => $request->input('kepuasan'),
            'pungutan' => $request->input('pungutan'),
            'saran' => $request->input('saran'),
            'instansi_id' => $request->input('instansi_id'),
        ]);

        return redirect()->route('hasil.index')->with('success', 'Hasil telah berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hasil $hasil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hasil $hasil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hasil $hasil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hasil $hasil)
    {
        //
    }
}
