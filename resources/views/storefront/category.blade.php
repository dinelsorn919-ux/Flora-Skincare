@extends('layouts.app')

@section('title', $categoryLabel . ' — Flora Skincare')

@section('content')
    <div class="max-w-6xl mx-auto px-6 pt-10 pb-16">
        
        <!-- Header / Back Button Section -->
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink/70 hover:text-forest transition-colors bg-white border border-line/80 px-4 py-2.5 rounded-xl shadow-2xs">
                &larr; Back to Homepage
            </a>
        </div>
        
        <!-- Category Title & Horizontal Category Pills -->
        <div class="mb-8">
            <h1 class="font-display text-3xl text-ink mb-4">{{ $categoryLabel }}</h1>
            
            <div class="flex flex-wrap items-center gap-2 pb-4 border-b border-line">
                @foreach(\App\Models\Category::all() as $cat)
                    <a href="{{ route('category', $cat->slug) }}" 
                       class="px-3 py-1.5 text-xs rounded-full border transition-all {{ $categoryLabel === $cat->name ? 'bg-forest text-bone border-forest' : 'border-line text-ink/70 hover:border-forest bg-white' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Smaller, Compact Product Grid (4 columns) -->
        @if ($products->isEmpty())
            <p class="text-ink/60 text-sm py-8">No products found in this category.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($products as $product)
                    @php
                        $imageUrl = str_starts_with($product->image ?? '', 'http') 
                            ? $product->image 
                            : ($product->image ? asset('storage/' . ltrim($product->image, '/storage/')) : null);
                    @endphp

                    <div class="bg-white border border-line rounded-md flex flex-col justify-between hover:border-forest transition-all overflow-hidden shadow-sm group">
                        <div>
                            <!-- Clickable Image to Product Detail -->
                            <a href="{{ route('product.show', $product->slug ?? $product->id) }}">
                                @if($imageUrl)
                                    <div class="w-full h-52 bg-white p-3 flex items-center justify-center overflow-hidden relative">
                                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="w-full h-52 bg-forest/5 flex items-center justify-center text-xs text-forest/60">No image</div>
                                @endif
                            </a>

                            <div class="p-3">
                                <!-- Clickable Title to Product Detail -->
                                <h3 class="text-xs font-medium text-ink line-clamp-1 mb-1 text-center">
                                    <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="hover:text-forest transition-colors">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="text-[11px] text-ink/60 line-clamp-1 mb-2 text-center">{{ $product->description }}</p>
                            </div>
                        </div>
                        
                        <div class="p-3 pt-0">
                            <div class="flex items-center justify-center gap-2 mb-3">
                                <span class="text-xs font-semibold text-ink">${{ number_format($product->price, 2) }}</span>
                                @if(isset($product->compare_price) && $product->compare_price > $product->price)
                                    <span class="text-[10px] text-ink/40 line-through">${{ number_format($product->compare_price, 2) }}</span>
                                @endif
                            </div>
                            
                            <form action="{{ route('cart.add', $product->id ?? 1) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-forest text-bone text-[11px] py-1.5 rounded-sm hover:bg-forestdark transition-colors">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection