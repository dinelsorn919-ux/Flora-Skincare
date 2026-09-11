<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'short_description',
        'description',
        'price',
        'compare_price',
        'image',
        'stock',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    public static function categories(): array
    {
        return [
            'cleansers' => 'Cleansers',
            'serums' => 'Serums',
            'moisturizers' => 'Moisturizers',
            'makeup' => 'Makeup',
        ];
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function inStock(): bool
    {
        return $this->stock > 0;
    }
}
