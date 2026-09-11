<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Bakuchiol Renewal Serum',
                'category' => 'serums',
                'short_description' => 'Gentle retinol alternative',
                'description' => 'A plant-derived serum that smooths fine lines and evens tone without the sensitivity of traditional retinol. Use nightly after cleansing.',
                'price' => 58.00,
                'compare_price' => null,
                'image' => 'https://placehold.co/700x875/2F3B2A/FAF8F3?text=Bakuchiol+Serum',
                'stock' => 40,
                'is_featured' => true,
            ],
            [
                'name' => 'Oat Milk Cream Cleanser',
                'category' => 'cleansers',
                'short_description' => 'Balm-to-milk daily wash',
                'description' => 'A pH-balanced cleanser that lifts away makeup and SPF without stripping the skin barrier. Suited to dry and sensitive skin.',
                'price' => 26.00,
                'compare_price' => null,
                'image' => 'https://placehold.co/700x875/2F3B2A/FAF8F3?text=Oat+Milk+Cleanser',
                'stock' => 65,
                'is_featured' => true,
            ],
            [
                'name' => 'Barrier Repair Night Cream',
                'category' => 'moisturizers',
                'short_description' => 'Ceramide-rich overnight repair',
                'description' => 'A rich, ceramide-and-squalane cream that restores the skin barrier while you sleep. Fragrance-free and non-comedogenic.',
                'price' => 42.00,
                'compare_price' => 52.00,
                'image' => 'https://placehold.co/700x875/2F3B2A/FAF8F3?text=Night+Cream',
                'stock' => 30,
                'is_featured' => true,
            ],
            [
                'name' => 'Rosewater Toning Mist',
                'category' => 'cleansers',
                'short_description' => 'Hydrating multi-use mist',
                'description' => 'A lightweight mist that refreshes and preps skin for serums, or sets makeup throughout the day.',
                'price' => 22.00,
                'compare_price' => null,
                'image' => 'https://placehold.co/700x875/2F3B2A/FAF8F3?text=Toning+Mist',
                'stock' => 80,
                'is_featured' => false,
            ],
            [
                'name' => 'Vitamin C Brightening Drops',
                'category' => 'serums',
                'short_description' => '15% stabilized vitamin C',
                'description' => 'A stable, low-irritation vitamin C formula that fades dark spots and brightens dull skin over time.',
                'price' => 48.00,
                'compare_price' => null,
                'image' => 'https://placehold.co/700x875/2F3B2A/FAF8F3?text=Vitamin+C+Drops',
                'stock' => 25,
                'is_featured' => false,
            ],
            [
                'name' => 'Sheer Tint Mineral SPF 30',
                'category' => 'makeup',
                'short_description' => 'Lightweight everyday sunscreen',
                'description' => 'A mineral sunscreen with a soft tint that wears well alone or under makeup. No white cast.',
                'price' => 34.00,
                'compare_price' => null,
                'image' => 'https://placehold.co/700x875/2F3B2A/FAF8F3?text=Mineral+SPF',
                'stock' => 50,
                'is_featured' => false,
            ],
            [
                'name' => 'Clay & Charcoal Deep Wash',
                'category' => 'cleansers',
                'short_description' => 'For congested, oily skin',
                'description' => 'A detoxifying cleanser with kaolin clay and activated charcoal that draws out impurities without over-drying.',
                'price' => 24.00,
                'compare_price' => null,
                'image' => 'https://placehold.co/700x875/2F3B2A/FAF8F3?text=Clay+Cleanser',
                'stock' => 55,
                'is_featured' => false,
            ],
            [
                'name' => 'Sheer Silk Lip Tint',
                'category' => 'makeup',
                'short_description' => 'Buildable everyday color',
                'description' => 'A weightless, treatment-grade lip tint with hyaluronic acid, in a warm rose shade that suits most skin tones.',
                'price' => 19.00,
                'compare_price' => null,
                'image' => 'https://placehold.co/700x875/2F3B2A/FAF8F3?text=Lip+Tint',
                'stock' => 70,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => Str::slug($product['name'])],
                array_merge($product, ['slug' => Str::slug($product['name'])])
            );
        }
    }
}
