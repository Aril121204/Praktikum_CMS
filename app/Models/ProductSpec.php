<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    use HasFactory;

    protected $table = 'product_specs';

    protected $fillable = [
        'product_id',
        'processor',
        'ram',
        'storage',
        'expandable_storage',
        'display',
        'resolution',
        'camera_rear',
        'camera_front',
        'battery',
        'charging',
        'os',
        'connectivity',
        'dimensions',
        'colors',
        'other_specs',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}