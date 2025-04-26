@extends('admin.layouts.app')

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
                    @if (isset($selectedAnggaranId))
                        @php
                            $selected = $anggarans->where('id', $selectedAnggaranId)->first();
                        @endphp
                        <div class="alert alert-info">
                            <strong>Mengisi untuk Anggaran:</strong><br>
                            <span>No Surat: <strong>{{ $selected->no_surat }}</strong></span><br>
                            <span>Divisi: <strong>{{ $selected->divisi }}</strong></span>
                        </div>
                    @endif

                    <!-- Form untuk input item -->
                    <div id="item-input-form">
                        <input type="hidden" id="id_anggaran" value="{{ $selectedAnggaranId }}">

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="barang_yang_diajukan">Barang yang Diajukan</label>
                                <input type="text" id="barang_yang_diajukan" class="form-control">
                                <div class="invalid-feedback" id="barang_error"></div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="qty">Jumlah</label>
                                <input type="number" id="qty" class="form-control">
                                <div class="invalid-feedback" id="qty_error"></div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="harga">Harga</label>
                                <input type="number" id="harga" class="form-control">
                                <div class="invalid-feedback" id="harga_error"></div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="kode_pajak">Kode Pajak</label>
                                <input type="text" id="kode_pajak" class="form-control">
                                <div class="invalid-feedback" id="pajak_error"></div>
                            </div>

                            <div class="col-md-1 mb-3">
                                <label>&nbsp;</label>
                                <button type="button" id="tambah_item" class="btn btn-success form-control">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel untuk menampilkan items sebelum disimpan -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="items_table">
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
                                <!-- Items will be added here dynamically -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                    <td colspan="2"><strong id="grand_total">0</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Form untuk menyimpan semua items -->
                    <form action="{{ route('detail-anggaran.store') }}" method="POST" id="submit_form">
                        @csrf
                        <input type="hidden" name="id_anggaran" value="{{ $selectedAnggaranId }}">
                        <input type="hidden" name="detail_items" id="detail_items">

                        <div class="mt-4">
                            <button type="button" id="simpan_semua" class="btn btn-primary">Simpan Semua</button>
                            <a href="{{ route('detail-anggaran.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let items = [];
        const itemsTable = document.getElementById('items_table').getElementsByTagName('tbody')[0];
        const tambahItemBtn = document.getElementById('tambah_item');
        const simpanSemuaBtn = document.getElementById('simpan_semua');
        const detailItemsInput = document.getElementById('detail_items');
        const idAnggaran = document.getElementById('id_anggaran').value;
        
        // Add item to table
        tambahItemBtn.addEventListener('click', function() {
            const barang = document.getElementById('barang_yang_diajukan').value.trim();
            const qty = document.getElementById('qty').value;
            const harga = document.getElementById('harga').value;
            const kodePajak = document.getElementById('kode_pajak').value.trim();
            
            // Reset error messages
            document.getElementById('barang_error').textContent = '';
            document.getElementById('qty_error').textContent = '';
            document.getElementById('harga_error').textContent = '';
            document.getElementById('pajak_error').textContent = '';
            
            // Validate inputs
            let hasError = false;
            
            if (!barang) {
                document.getElementById('barang_yang_diajukan').classList.add('is-invalid');
                document.getElementById('barang_error').textContent = 'Barang harus diisi';
                hasError = true;
            } else {
                document.getElementById('barang_yang_diajukan').classList.remove('is-invalid');
            }
            
            if (!qty || qty <= 0) {
                document.getElementById('qty').classList.add('is-invalid');
                document.getElementById('qty_error').textContent = 'Jumlah harus diisi dengan angka positif';
                hasError = true;
            } else {
                document.getElementById('qty').classList.remove('is-invalid');
            }
            
            if (!harga || harga <= 0) {
                document.getElementById('harga').classList.add('is-invalid');
                document.getElementById('harga_error').textContent = 'Harga harus diisi dengan angka positif';
                hasError = true;
            } else {
                document.getElementById('harga').classList.remove('is-invalid');
            }
            
            if (!kodePajak) {
                document.getElementById('kode_pajak').classList.add('is-invalid');
                document.getElementById('pajak_error').textContent = 'Kode pajak harus diisi';
                hasError = true;
            } else {
                document.getElementById('kode_pajak').classList.remove('is-invalid');
            }
            
            if (hasError) {
                return;
            }
            
            const total = parseFloat(qty) * parseFloat(harga);
            
            // Create item object
            const item = {
                barang_yang_diajukan: barang,
                qty: parseInt(qty),
                harga: parseFloat(harga),
                kode_pajak: kodePajak,
                total: total,
                id_anggaran: idAnggaran
            };
            
            // Add to items array
            items.push(item);
            
            // Update hidden input with JSON data
            detailItemsInput.value = JSON.stringify(items);
            
            // Add row to table
            const newRow = itemsTable.insertRow();
            newRow.innerHTML = `
                <td>${barang}</td>
                <td>${qty}</td>
                <td>${formatRupiah(harga)}</td>
                <td>${kodePajak}</td>
                <td>${formatRupiah(total)}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm hapus-item" data-index="${items.length - 1}">
                        Hapus
                    </button>
                </td>
            `;
            
            // Clear form inputs
            document.getElementById('barang_yang_diajukan').value = '';
            document.getElementById('qty').value = '';
            document.getElementById('harga').value = '';
            document.getElementById('kode_pajak').value = '';
            document.getElementById('barang_yang_diajukan').focus();
            
            // Update grand total
            updateGrandTotal();
            
            // Add event listener to delete button
            addDeleteListeners();
        });
        
        // Format rupiah
        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }
        
        // Update grand total
        function updateGrandTotal() {
            const grandTotal = items.reduce((total, item) => total + item.total, 0);
            document.getElementById('grand_total').textContent = formatRupiah(grandTotal);
        }
        
        // Add delete event listeners
        function addDeleteListeners() {
            const deleteButtons = document.querySelectorAll('.hapus-item');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    
                    // Remove item from array
                    items.splice(index, 1);
                    
                    // Update hidden input
                    detailItemsInput.value = JSON.stringify(items);
                    
                    // Rebuild table
                    rebuildTable();
                });
            });
        }
        
        // Rebuild table after deletion
        function rebuildTable() {
            // Clear table
            itemsTable.innerHTML = '';
            
            // Rebuild table with updated indexes
            items.forEach((item, index) => {
                const row = itemsTable.insertRow();
                row.innerHTML = `
                    <td>${item.barang_yang_diajukan}</td>
                    <td>${item.qty}</td>
                    <td>${formatRupiah(item.harga)}</td>
                    <td>${item.kode_pajak}</td>
                    <td>${formatRupiah(item.total)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm hapus-item" data-index="${index}">
                            Hapus
                        </button>
                    </td>
                `;
            });
            
            // Update grand total
            updateGrandTotal();
            
            // Add delete listeners again
            addDeleteListeners();
        }
        
        // Submit all items
        simpanSemuaBtn.addEventListener('click', function() {
            if (items.length === 0) {
                alert('Belum ada barang yang ditambahkan!');
                return;
            }
            
            document.getElementById('submit_form').submit();
        });
    });
</script>

@endsection