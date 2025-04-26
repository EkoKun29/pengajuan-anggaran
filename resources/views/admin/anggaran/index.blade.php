@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Anggaran</h5>
        <a href="{{ route('anggaran.create') }}">
            <button class="btn btn-primary" style="margin-top: 10px">Input Anggaran</button>
          </a>
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>No Surat</th>
                            <th>Divisi</th>
                            <th>Plot yang Dipakai</th>
                            <th>Akun Biaya</th>
                            <th>Nama Karyawan</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($anggarans as $index => $anggaran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($anggaran->tanggal_pengajuan)->format('d-m-Y') }}</td>
                                <td>{{ $anggaran->no_surat }}</td>
                                <td>{{ $anggaran->divisi }}</td>
                                <td>{{ $anggaran->plot_yang_dipakai }}</td>
                                <td>{{ $anggaran->akun_biaya}}</td>
                                <td>{{ $anggaran->nama_karyawan }}</td>
                                <td>{{ $anggaran->user->name ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('anggaran.edit', $anggaran->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <a href="#" class="btn btn-danger btn-sm" 
                                           title="Hapus"
                                           onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $anggaran->id }}').submit();">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        
                                        <form id="delete-form-{{ $anggaran->id }}" 
                                              action="{{ route('anggaran.destroy', $anggaran->id) }}" 
                                              method="POST" 
                                              style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        
                                        <a href="{{ route('detail-anggaran.showByAnggaran', $anggaran->id) }}" class="btn btn-success btn-sm" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data anggaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
