<?php

namespace App\Models;

use App\Models\Anggaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailAnggaran extends Model
{
    protected $fillable = [
        'id_anggaran',
        'barang_yang_diajukan',
        'qty',
        'harga',
        'kode_pajak',
        'status_pengajuan'
    ];

    public function anggaran(): BelongsTo
    {
        return $this->belongsTo(Anggaran::class, 'id_anggaran');
    }
}
