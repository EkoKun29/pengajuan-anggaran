@extends('admin_super.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Riwayat Pengajuan Anggaran</h5>

    <table class="table datatable">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Barang Yang Diajukan</th>
                <th>Qty</th>
                <th>Harga</th>
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
                <td style="text-align: center">
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
