@extends('layouts.app')

@section('title', $product->name.' — Flora Skincare')

@section('content')

    @php
        $imageUrl = str_starts_with($product->image ?? '', 'http') 
            ? $product->image 
            : ($product->image ? asset('storage/' . ltrim($product->image ?? '', '/storage/')) : null);
    @endphp

    <section class="max-w-5xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-10 items-center">
        <!-- Smaller Image Container -->
        <div class="w-full h-80 md:h-96 border border-line rounded-sm overflow-hidden bg-white p-4 flex items-center justify-center">
            @if($imageUrl)
                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
            @else
                <div class="w-full h-full flex items-center justify-center bg-forest/5 text-forest/60 text-xs">
                    No image available
                </div>
            @endif
        </div>

        <div>
            <p class="text-sm text-clay mb-2">{{ \App\Models\Product::categories()[$product->category] ?? $product->category }}</p>
            <h1 class="font-display text-3xl text-ink mb-3">{{ $product->name }}</h1>
            <p class="text-ink/70 mb-6 text-sm">{{ $product->short_description }}</p>

            <p class="text-xl text-ink mb-6 font-semibold">
                ${{ number_format($product->price, 2) }}
                @if ($product->compare_price && $product->compare_price > $product->price)
                    <span class="text-ink/40 line-through text-base font-normal ml-2">${{ number_format($product->compare_price, 2) }}</span>
                @endif
            </p>

            @if (method_exists($product, 'inStock') ? $product->inStock() : true)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" class="w-16 border border-line rounded-sm px-3 py-2 text-xs">
                    <button type="submit" class="flex-1 bg-forest text-bone py-2 rounded-sm hover:bg-forestdark transition-colors text-xs">
                        Add to bag
                    </button>
                </form>
            @else
                <p class="text-ink/50 border border-line rounded-sm px-4 py-2 inline-block text-xs">Currently out of stock</p>
            @endif

            <div class="mt-8 pt-6 border-t border-line">
                <h2 class="font-display text-base text-ink mb-2">Full description</h2>
                <p class="text-ink/70 leading-relaxed text-xs">{{ $product->description }}</p>
            </div>
        </div>
    </section>

    @if (isset($related) && $related->isNotEmpty())
        <section class="max-w-5xl mx-auto px-6 pb-20 border-t border-line pt-12">
            <h2 class="font-display text-xl text-ink mb-6">You might also like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($related as $item)
                    @include('storefront.partials.product-card', ['product' => $item])
                @endforeach
            </div>
        </section>
    @endif

@endsection