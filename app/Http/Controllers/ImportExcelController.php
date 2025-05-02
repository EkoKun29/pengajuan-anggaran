<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Divisi;
use App\Models\PlotYangDipakai;
use App\Models\NamaKaryawan;

class ImportExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        // Hapus semua data sebelumnya
        PlotYangDipakai::truncate();
        NamaKaryawan::truncate();
        Divisi::truncate();

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; 

            $plottingBudget = $row[0] ?? null; // Kolom A
            $namaKaryawan = $row[2] ?? null;   // Kolom C
            $divisi = $row[4] ?? null;         // Kolom E

            if ($plottingBudget) {
                PlotYangDipakai::create([
                    'plotting_budget' => $plottingBudget
                ]);
            }

            if ($namaKaryawan) {
                NamaKaryawan::create([
                    'nama' => $namaKaryawan
                ]);
            }

            if ($divisi) {
                Divisi::create([
                    'divisi' => $divisi
                ]);
            }
        }

        return back()->with('success', 'Data berhasil diimport dan data lama telah dihapus.');
    }
}
