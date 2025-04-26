<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    // Menampilkan semua data anggaran
    public function index()
    {
        $anggarans = Anggaran::with('user')->get();
        return view('admin.anggaran.index', compact('anggarans'));
    }

    // Menampilkan form untuk membuat anggaran baru
    public function create()
    {
        return view('admin.anggaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pengajuan' => 'required|date',
            'divisi' => 'required|string|max:255',
            'plot_yang_dipakai' => 'required|string|max:255',
            'akun_biaya' => 'required|string',
            'nama_karyawan' => 'required|string|max:255',
        ]);

        // Tambahkan id user yang login
        $validated['id_user'] = auth()->user()->id;

        // Generate nomor surat otomatis
        $last = \App\Models\Anggaran::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        $validated['no_surat'] = 'PENGJ-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Simpan anggaran
        $anggaran = \App\Models\Anggaran::create($validated);

        return redirect()->route('detail-anggaran.create', ['id_anggaran' => $anggaran->id])
            ->with('success', 'Anggaran berhasil ditambahkan. Silakan tambahkan detail anggaran.');
    }

    // Menampilkan satu data anggaran
    public function show($id)
    {
        $anggaran = Anggaran::with('user', 'detailAnggarans')->findOrFail($id);
        return view('admin.anggaran.show', compact('anggaran'));
    }

    // Menampilkan form untuk edit anggaran
    public function edit($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        return view('admin.anggaran.edit', compact('anggaran'));
    }

    // Mengupdate anggaran
    public function update(Request $request, $id)
    {
        $anggaran = Anggaran::findOrFail($id);

        $validated = $request->validate([
            'tanggal_pengajuan' => 'required|date',
            'no_surat' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'plot_yang_dipakai' => 'required|string|max:255',
            'akun_biaya' => 'required|string',
            'nama_karyawan' => 'required|string|max:255',
        ]);

        $validated['id_user'] = auth()->user()->id; 

        $anggaran->update($validated);

        return redirect()->route('anggaran.index')
            ->with('success', 'Anggaran berhasil diperbarui.');
    }

    // Menghapus anggaran
    public function destroy($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->delete();

        return redirect()->route('anggaran.index')
            ->with('success', 'Anggaran berhasil dihapus.');
    }
}