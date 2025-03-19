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
    public function index(Request $request)
    {
        $query = Instansi::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_instansi', 'like', '%' . $request->search . '%');
        }

        $instansi = $query->paginate(5);

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
    public function show(Instansi $instansi, Request $request)
    {
        $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ], [
            'end_date.after_or_equal' => 'Tanggal akhir tidak boleh sebelum dari tanggal mulai.',
        ]);

        $baseQuery = $instansi->hasil();

        if ($request->filled(['start_date', 'end_date'])) {
            $baseQuery->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $allData = $baseQuery->get();

        $statistics = [
            'total' => $allData->count(),
            'kepuasan' => [
                'Sangat Puas' => $allData->where('kepuasan', 'Sangat Puas')->count(),
                'Puas' => $allData->where('kepuasan', 'Puas')->count(),
                'Cukup Puas' => $allData->where('kepuasan', 'Cukup Puas')->count(),
                'Tidak Puas' => $allData->where('kepuasan', 'Tidak Puas')->count(),
            ],
            'pungutan' => [
                'Ada' => $allData->where('pungutan', 'Ada')->count(),
                'Tidak Ada' => $allData->where('pungutan', 'Tidak Ada')->count(),
            ],
            'total_saran' => $allData->whereNotNull('saran')->where('saran', '!=', '')->count()
        ];

        $paginationQuery = $instansi->hasil();

        if ($request->filled(['start_date', 'end_date'])) {
            $paginationQuery->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $hasil = $paginationQuery->paginate(5);

        return view('instansi.show', compact('instansi', 'hasil', 'statistics'));
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
