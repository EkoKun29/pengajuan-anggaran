<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Models\DetailAnggaran;
use Illuminate\Support\Facades\Auth;

class DetailAnggaranController extends Controller
{
    // Menampilkan semua detail anggaran
    public function index()
    {
        $detailAnggarans = DetailAnggaran::with('anggaran')->get();
        return view('admin.detail_anggaran.index', compact('detailAnggarans'));
    }

    // Menampilkan form untuk membuat detail anggaran baru
    public function create(Request $request)
    {
        $selectedAnggaranId = $request->id_anggaran;
        $anggarans = \App\Models\Anggaran::all();

        return view('admin.detail-anggaran.create', compact('selectedAnggaranId', 'anggarans'));
    }
    

    // Menyimpan detail anggaran baru
    public function store(Request $request)
    {
        // Validate the main request
        $request->validate([
            'id_anggaran' => 'required|exists:anggarans,id',
            'detail_items' => 'required|json'
        ]);
        
        // Decode JSON items
        $items = json_decode($request->detail_items, true);
        
        // Counter for successful inserts
        $successCount = 0;
        
        // Process each item
        foreach ($items as $item) {
            // Create detail anggaran for each item
            DetailAnggaran::create([
                'barang_yang_diajukan' => $item['barang_yang_diajukan'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'kode_pajak' => $item['kode_pajak'],
                'id_anggaran' => $request->id_anggaran,
            ]);
            
            $successCount++;
        }
        
        // Success message with count
        $message = $successCount . ' item detail anggaran berhasil disimpan.';
        
        // Redirect based on user role
        $user = Auth::user();
        if ($user->role === 'admin super') {
            return redirect()->route('admin_super.ASanggaran.index')->with('success', $message);
        } elseif ($user->role === 'admin') {
            return redirect()->route('anggaran.index')->with('success', $message);
        }
        
        // If role not recognized, redirect to login
        return redirect()->route('login')->with('error', 'Role tidak dikenali.');
    }

    // Menampilkan detail anggaran berdasarkan id
    public function show($id)
    {
        $detailAnggaran = DetailAnggaran::with('anggaran')->findOrFail($id);
        return view('admin.detail_anggaran.show', compact('detailAnggaran'));
    }

    // Menampilkan form untuk mengedit detail anggaran
    public function edit($id)
    {
        $detailAnggaran = DetailAnggaran::findOrFail($id);
        $anggarans = Anggaran::all(); // Mengambil semua anggaran untuk dropdown
        return view('admin.detail_anggaran.edit', compact('detailAnggaran', 'anggarans'));
    }

    // Mengupdate detail anggaran
    public function update(Request $request, $id)
    {
        $detailAnggaran = DetailAnggaran::findOrFail($id);

        $validated = $request->validate([
            'id_anggaran' => 'required|exists:anggarans,id', 
            'barang_yang_diajukan' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'kode_pajak' => 'required|string|max:50',
            'status_pengajuan' => 'required|string|max:50',
        ]);

        $detailAnggaran->update($validated);

        return redirect()->route('detail-anggaran.index')
            ->with('success', 'Detail anggaran berhasil diperbarui.');
    }

    // Menghapus detail anggaran
    public function destroy($id)
    {
        $detailAnggaran = DetailAnggaran::findOrFail($id);
        $detailAnggaran->delete();

        return redirect()->route('detail-anggaran.index')
            ->with('success', 'Detail anggaran berhasil dihapus.');
    }

    public function showByAnggaran($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $details = DetailAnggaran::where('id_anggaran', $id)->get();

        return view('admin.detail-anggaran.show', compact('anggaran', 'details'));
    }

    public function createas($id_anggaran)
    {
        // Ambil data anggaran untuk digunakan di view
        $anggaran = Anggaran::findOrFail($id_anggaran);

        // Mengirimkan data ke view
        return view('admin_super.detail-anggaran.create', compact('anggaran'));
    }

}
