@extends('direktur.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Daftar Pengajuan Anggaran</h5>
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengajuan</th>
                    <th>No Surat</th>
                    <th>Divisi</th>
                    <th>Plot Yang Dipakai</th>
                    <th>Diajukan Oleh</th>
                    <th>Akun Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggarans as $index => $anggaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($anggaran->tanggal_pengajuan)->format('d-m-Y') }}</td>
                        <td>{{ $anggaran->no_surat }}</td>
                        <td>{{ $anggaran->divisi }}</td>
                        <td>{{ $anggaran->divisi }}</td>
                        <td>{{ $anggaran->user->name ?? '-' }}</td>
                        <td>{{ $anggaran->akun_biaya }}</td>
                        <td>
                            <!-- Tombol Detail -->
                            <a href="{{ route('direktur.pengajuan.detail', $anggaran->id) }}" class="btn btn-sm btn-primary" title="Lihat Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- Tombol ACC Detail -->
                            @foreach($anggaran->detailAnggarans as $detail)
                                @if($detail->status_pengajuan == 0)
                                    <form action="{{ route('direktur.pengajuan.acc', $detail->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning" title="Belum Disetujui">
                                            <i class="bi bi-x-circle"></i> 
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-success" disabled title="Sudah Disetujui">
                                        <i class="bi bi-check-circle"></i> 
                                    </button>
                                @endif
                                <br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
