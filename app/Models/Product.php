<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'model',
        'slug',
        'price',
        'discount_price',
        'discount_percent',
        'stock',
        'condition',
        'description',
        'philosophy',
        'image',
        'is_active',
        'is_featured',
        'is_hot_deal',
        'is_gaming',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Set ID null agar trigger Oracle yang generate
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->id = null;
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function spec()
    {
        return $this->hasOne(ProductSpec::class, 'product_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 'Y');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 'Y');
    }

    public function scopeHotDeal($query)
    {
        return $query->where('is_hot_deal', 'Y');
    }

    public function scopeGaming($query)
    {
        return $query->where('is_gaming', 'Y');
    }

    public function scopeLatest($query)
    {
        return $query->orderByRaw('CREATED_AT DESC');
    }
}