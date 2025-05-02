@extends('admin_super.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Anggaran </h3>
                </div>
                <div class="card-body">
            <form action="{{ route('admin_super.ASanggaran.update', $anggaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                    <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ $anggaran->tanggal_pengajuan }}" required>
                </div>

                <div class="mb-3">
                    <label for="no_surat" class="form-label">No Surat</label>
                    <input type="text" name="no_surat" class="form-control" value="{{ $anggaran->no_surat }}" required readonly>
                </div>

                <div class="mb-3">
                    <label for="divisi" class="form-label">Divisi</label>
                    <select name="divisi" class="form-control" required>
                        <option value="">Pilih Divisi</option>
                        @foreach(App\Models\Divisi::select('divisi')->distinct()->get() as $div)
                            <option value="{{ $div->divisi }}" {{ $anggaran->divisi == $div->divisi ? 'selected' : '' }}>
                                {{ $div->divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="plot_yang_dipakai" class="form-label">Plot Yang Diapaki</label>
                    <select name="plot_yang_dipakai" class="form-control" required>
                        <option value="">Pilih Plot Yang Dipakai</option>
                        @foreach(App\Models\PlotYangDipakai::select('plotting_budget')->distinct()->get() as $plt)
                            <option value="{{ $plt->plotting_budget }}" {{$anggaran->plot_yang_dipakai == $plt->plotting_budget ? 'selected' : '' }}>
                                {{ $plt->plotting_budget }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="akun_biaya" class="form-label">Akun Biaya</label>
                    <input type="text" name="akun_biaya" class="form-control" value="{{ $anggaran->akun_biaya }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                    <select name="nama_karyawan" class="form-control" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach(App\Models\NamaKaryawan::select('nama')->distinct()->get() as $nam)
                            <option value="{{ $nam->nama }}" {{$anggaran->nama_karyawan == $nam->nama ? 'selected' : '' }}>
                                {{ $nam->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin_super.ASanggaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
