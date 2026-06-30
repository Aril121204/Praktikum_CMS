<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'total', 'pelanggan_id', 'admin_id'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
