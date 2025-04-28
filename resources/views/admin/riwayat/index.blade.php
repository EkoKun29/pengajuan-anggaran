@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Riwayat Pengajuan Anggaran</h5>

    <table class="table datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Barang Yang Diajukan</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Diajukan Oleh</th>
                <th>Status Pengajuan</th>
            </tr>
        </thead>
        <?php $no =1; ?>
        <tbody>
            @foreach($riwayatAnggarans as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->anggaran->no_surat ?? '-' }}</td>
                <td>{{ $item->barang_yang_diajukan }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->anggaran->user->name }}</td>
                <td>
                    @if($item->status_pengajuan == 1)
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-warning">Belum Disetujui</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
