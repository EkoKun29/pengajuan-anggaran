@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Input Data Anggaran </h3>
                </div>
                <div class="card-body">

            <form action="{{ route('anggaran.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                    <input type="date" name="tanggal_pengajuan" class="form-control" required>
                </div>

                {{-- <div class="mb-3">
                    <label for="no_surat" class="form-label">No Surat</label>
                    <input type="text" name="no_surat" class="form-control" required>
                </div> --}}

                <div class="mb-3">
                    <label for="divisi" class="form-label">Divisi</label>
                    <select name="divisi" class="form-control" required>
                        <option value="">Pilih Divisi</option>
                        @foreach(App\Models\Divisi::select('divisi')->distinct()->get() as $div)
                            <option value="{{ $div->divisi }}">{{ $div->divisi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="plot_yang_dipakai" class="form-label">Plot yang Dipakai</label>
                    <select name="plot_yang_dipakai" class="form-control" required>
                        <option value="">Pilih Plotting Budget</option>
                        @foreach (App\Models\PlotYangDipakai::select('plotting_budget')->distinct()->get() as $plt )
                            <option value="{{ $plt->plotting_budget }}">{{ $plt->plotting_budget }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="akun_biaya" class="form-label">Akun Biaya</label>
                    <input type="text" name="akun_biaya" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                    <select name="nama_karyawan" class="form-control" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach (App\Models\NamaKaryawan::select('nama')->distinct()->get() as $nam )
                            <option value="{{ $nam->nama }}">{{ $nam->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('anggaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
