<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPengajuanDana extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_item',
        'jumlah',
        'satuan',
        'harga',
        'total',
    ];

    /**
     * Get the pengajuan dana that owns the item.
     */
    public function pengajuanDana()
    {
        return $this->belongsTo(PengajuanDana::class);
    }
}
