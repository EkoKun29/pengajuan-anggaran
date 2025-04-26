@extends('admin_super.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Detail Anggaran</h3>
                </div>
                <div class="card-body">
                    <!-- Menampilkan info anggaran yang sedang diisi -->
                    <div class="alert alert-info">
                        <strong>Mengisi untuk Anggaran:</strong><br>
                        <span>No Surat: <strong>{{ $anggaran->no_surat }}</strong></span><br>
                        <span>Divisi: <strong>{{ $anggaran->divisi }}</strong></span>
                    </div>

                    <!-- Form input barang -->
                    <div id="form-input-barang">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="barang_yang_diajukan">Barang yang Diajukan</label>
                                <input type="text" id="barang_yang_diajukan" class="form-control">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="qty">Jumlah</label>
                                <input type="number" id="qty" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="harga">Harga</label>
                                <input type="number" id="harga" class="form-control">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="kode_pajak">Kode Pajak</label>
                                <input type="text" id="kode_pajak" class="form-control">
                            </div>

                            <div class="col-md-1 mb-3">
                                <label>&nbsp;</label>
                                <button type="button" onclick="tambahBarang()" class="btn btn-success form-control">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel barang yang sudah ditambahkan -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="tabel_barang">
                            <thead>
                                <tr>
                                    <th>Barang yang Diajukan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Kode Pajak</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Barang akan ditambahkan di sini -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                    <td colspan="2"><strong id="grand_total">0</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Form untuk menyimpan semua barang -->
                    <form action="{{ route('detail-anggaran.store') }}" method="POST" id="form_submit">
                        @csrf
                        <input type="hidden" name="id_anggaran" value="{{ $anggaran->id }}">
                        <input type="hidden" name="detail_items" id="detail_items">

                        <div class="form-group mt-3">
                            <button type="button" onclick="simpanSemua()" class="btn btn-primary">Simpan Semua</button>
                            <a href="{{ route('admin_super.ASanggaran.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Array untuk menyimpan barang
    let daftarBarang = [];

    // Fungsi untuk menambah barang ke tabel
    function tambahBarang() {
        // Ambil nilai dari form
        const barang = document.getElementById('barang_yang_diajukan').value.trim();
        const qty = document.getElementById('qty').value;
        const harga = document.getElementById('harga').value;
        const kodePajak = document.getElementById('kode_pajak').value.trim();
        
        // Validasi sederhana
        if (!barang || !qty || !harga || !kodePajak) {
            alert('Semua field harus diisi!');
            return;
        }
        
        if (qty <= 0) {
            alert('Jumlah harus lebih dari 0!');
            return;
        }
        
        if (harga <= 0) {
            alert('Harga harus lebih dari 0!');
            return;
        }
        
        // Hitung total
        const total = parseFloat(qty) * parseFloat(harga);
        
        // Buat objek barang
        const itemBarang = {
            barang_yang_diajukan: barang,
            qty: parseInt(qty),
            harga: parseFloat(harga),
            kode_pajak: kodePajak,
            total: total,
            id_anggaran: {{ $anggaran->id }}
        };
        
        // Tambahkan ke array
        daftarBarang.push(itemBarang);
        
        // Update hidden input untuk form submission
        document.getElementById('detail_items').value = JSON.stringify(daftarBarang);
        
        // Tambahkan ke tabel
        const tabelBarang = document.getElementById('tabel_barang').getElementsByTagName('tbody')[0];
        const newRow = tabelBarang.insertRow();
        newRow.innerHTML = `
            <td>${barang}</td>
            <td>${qty}</td>
            <td>${formatRupiah(harga)}</td>
            <td>${kodePajak}</td>
            <td>${formatRupiah(total)}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(${daftarBarang.length - 1})">
                    Hapus
                </button>
            </td>
        `;
        
        // Bersihkan form
        document.getElementById('barang_yang_diajukan').value = '';
        document.getElementById('qty').value = '';
        document.getElementById('harga').value = '';
        document.getElementById('kode_pajak').value = '';
        document.getElementById('barang_yang_diajukan').focus();
        
        // Update grand total
        updateGrandTotal();
    }
    
    // Format rupiah
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }
    
    // Hapus barang
    function hapusBarang(index) {
        // Hapus dari array
        daftarBarang.splice(index, 1);
        
        // Update hidden input
        document.getElementById('detail_items').value = JSON.stringify(daftarBarang);
        
        // Rebuild tabel
        rebuildTabel();
    }
    
    // Rebuild tabel setelah menghapus
    function rebuildTabel() {
        const tabelBarang = document.getElementById('tabel_barang').getElementsByTagName('tbody')[0];
        
        // Kosongkan tabel
        tabelBarang.innerHTML = '';
        
        // Isi ulang tabel
        daftarBarang.forEach((item, index) => {
            const row = tabelBarang.insertRow();
            row.innerHTML = `
                <td>${item.barang_yang_diajukan}</td>
                <td>${item.qty}</td>
                <td>${formatRupiah(item.harga)}</td>
                <td>${item.kode_pajak}</td>
                <td>${formatRupiah(item.total)}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(${index})">
                        Hapus
                    </button>
                </td>
            `;
        });
        
        // Update grand total
        updateGrandTotal();
    }
    
    // Update grand total
    function updateGrandTotal() {
        const grandTotal = daftarBarang.reduce((total, item) => total + item.total, 0);
        document.getElementById('grand_total').textContent = formatRupiah(grandTotal);
    }
    
    // Simpan semua barang
    function simpanSemua() {
        if (daftarBarang.length === 0) {
            alert('Belum ada barang yang ditambahkan!');
            return;
        }
        
        document.getElementById('form_submit').submit();
    }
</script>
@endsection