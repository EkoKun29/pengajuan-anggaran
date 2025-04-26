<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Models\DetailAnggaran;

class AdminSuperController extends Controller
{
    // Menampilkan semua data anggaran
    public function index()
    {
        $anggarans = Anggaran::with('user')->get();
        return view('admin_super.anggaran.index', compact('anggarans'));
    }

    // Form input anggaran
    public function create()
    {
        return view('admin_super.anggaran.create');
    }

    // Simpan data anggaran
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pengajuan' => 'required|date',
            'divisi' => 'required|string|max:255',
            'plot_yang_dipakai' => 'required|string|max:255',
            'akun_biaya' => 'required|string',
            'nama_karyawan' => 'required|string|max:255',
        ]);

        $validated['id_user'] = auth()->user()->id;

        $last = Anggaran::orderBy('id', 'desc')->first();
        $nextNumber = $last ? $last->id + 1 : 1;
        $validated['no_surat'] = 'PENGJ-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $anggaran = Anggaran::create($validated);

        return redirect()->route('admin_super.ASdetail-anggaran.create', ['id_anggaran' => $anggaran->id])
            ->with('success', 'Anggaran berhasil ditambahkan.');
    }

    // Show satu anggaran
    public function show($id)
    {
        $anggaran = Anggaran::with('user', 'detailAnggarans')->findOrFail($id);
        return view('admin_super.anggaran.show', compact('anggaran'));
    }

    // Form edit
    public function edit($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        return view('admin_super.anggaran.edit', compact('anggaran'));
    }

    // Proses update
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

        return redirect()->route('admin_super.ASanggaran.index')
            ->with('success', 'Anggaran berhasil diperbarui.');
    }

    // Hapus
    public function destroy($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->delete();

        return redirect()->route('admin_super.ASanggaran.index')
            ->with('success', 'Anggaran berhasil dihapus.');
    }

    public function showByAnggaran($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $details = DetailAnggaran::where('id_anggaran', $id)->get();

        return view('admin_super.detail-anggaran.show', compact('anggaran', 'details'));
    }
    
}
