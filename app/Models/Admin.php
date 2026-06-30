<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'username', 'password'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
