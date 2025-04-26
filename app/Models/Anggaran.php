<?php

namespace App\Models;

use App\Models\User;
use App\Models\DetailAnggaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anggaran extends Model
{
    protected $fillable = [
        'id_user',
        'tanggal_pengajuan',
        'no_surat',
        'divisi',
        'plot_yang_dipakai',
        'akun_biaya',
        'nama_karyawan'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detailAnggarans(): HasMany
    {
        return $this->hasMany(DetailAnggaran::class, 'id_anggaran');
    }
}
