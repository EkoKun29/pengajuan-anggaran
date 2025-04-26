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
                    <input type="text" name="divisi" class="form-control" value="{{ $anggaran->divisi }}" required>
                </div>

                <div class="mb-3">
                    <label for="plot_yang_dipakai" class="form-label">Plot yang Dipakai</label>
                    <input type="text" name="plot_yang_dipakai" class="form-control" value="{{ $anggaran->plot_yang_dipakai }}" required>
                </div>

                <div class="mb-3">
                    <label for="akun_biaya" class="form-label">Akun Biaya</label>
                    <input type="text" name="akun_biaya" class="form-control" value="{{ $anggaran->akun_biaya }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                    <input type="text" name="nama_karyawan" class="form-control" value="{{ $anggaran->nama_karyawan }}" required>
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
