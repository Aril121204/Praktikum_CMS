<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['merk', 'tipe', 'harga', 'stok', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
