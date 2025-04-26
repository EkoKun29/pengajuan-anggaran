<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Models\DetailAnggaran;
use Illuminate\Support\Facades\Auth;

class DirekturController extends Controller
{
    public function pengajuanAnggaran()
    {
        $anggarans = Anggaran::all();
        $role = Auth::user()->role;

        if ($role === 'direktur') {
            return view('direktur.pengajuan-anggaran.index', compact('anggarans'));
        } elseif ($role === 'admin super') {
            return view('admin_super.pengajuan-anggaran.index', compact('anggarans'));
        }

        abort(403, 'Role tidak dikenali.');
    }

    public function showDetail($id)
    {
        $anggaran = Anggaran::with('detailAnggarans')->findOrFail($id);
        $role = Auth::user()->role;

        if ($role === 'direktur') {
            return view('direktur.pengajuan-anggaran.detail', compact('anggaran'));
        } elseif ($role === 'admin super') {
            return view('admin_super.pengajuan-anggaran.detail', compact('anggaran'));
        }

        abort(403, 'Role tidak dikenali.');
    }

    public function accAnggaran($id)
    {
        $detailAnggaran = DetailAnggaran::findOrFail($id);
        $detailAnggaran->status_pengajuan = 1;
        $detailAnggaran->save();

        return redirect()->route('direktur.pengajuan.index')
                        ->with('success', 'Detail anggaran disetujui.');
    }
}
