@extends('admin_super.layouts.app')

@section('content')
<div class="container">
    <h2>Detail Anggaran</h2>

    <!-- Menampilkan info anggaran utama -->
    @if(isset($anggaran))
        <div class="alert alert-info">
            <strong>Anggaran:</strong><br>
            <span>No Surat: <strong>{{ $anggaran->no_surat }}</strong></span><br>
            <span>Divisi: <strong>{{ $anggaran->divisi }}</strong></span>
        </div>
    @endif

    <!-- Tabel detail anggaran -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Barang yang Diajukan</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Kode Pajak</th>
                <th>Status Pengajuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->barang_yang_diajukan }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>{{ $detail->kode_pajak }}</td>
                    <td>
                        @if($detail->status_pengajuan == 0)
                            <span class="badge bg-warning">Menunggu</span>
                        @elseif($detail->status_pengajuan == 1)
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>Rp {{ number_format($detail->qty * $detail->harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada detail anggaran</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin_super.ASanggaran.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
