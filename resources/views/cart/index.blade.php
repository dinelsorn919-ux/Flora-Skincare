@extends('layouts.app')

@section('title', 'Your Bag — Flora Skincare')

@section('content')
   <!-- Back to Home Link -->
    <div class="mt-4 max-w-6xl mx-auto px-6">
                        <a href="{{ route('home') }}" class="text-xs text-ink/60 hover:text-forest transition-colors">
                            ← Back to shopping
                        </a>
                    </div>
    <section class="max-w-6xl mx-auto px-6 py-12">
        <h1 class="font-display text-3xl text-ink mb-8">Your bag</h1>

        @if (empty($items))
            <div class="text-center py-16 bg-white border border-line rounded-lg p-8 max-w-lg mx-auto">
                <svg class="w-16 h-16 mx-auto text-forest/30 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.657 0 1.188.55 1.119 1.207z" />
                </svg>
                <p class="text-ink/60 text-sm mb-6">Your bag is currently empty.</p>
                <a href="{{ route('home') }}" class="inline-block bg-forest text-bone px-6 py-2.5 rounded-sm text-xs hover:bg-forestdark transition-colors">
                    Start shopping
                </a>
            </div>
        @else
            <!-- Modern Grid Layout: Left Items, Right Summary -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
                
                <!-- Left: Cart Items List -->
                <div class="lg:col-span-2 bg-white border border-line rounded-lg p-6 shadow-xs">
                    <div class="divide-y divide-line">
                        @foreach ($items as $item)
                            @php
                                $imageUrl = str_starts_with($item['product']->image ?? '', 'http') 
                                    ? $item['product']->image 
                                    : ($item['product']->image ? asset('storage/' . ltrim($item['product']->image ?? '', '/storage/')) : null);
                            @endphp

                            <div class="py-5 first:pt-0 last:pb-0 flex items-center gap-4 sm:gap-6">
                                <!-- Product Image -->
                                <div class="w-20 h-24 sm:w-24 sm:h-28 border border-line rounded-sm bg-white p-2 overflow-hidden flex items-center justify-center flex-shrink-0">
                                    @if($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $item['product']->name }}" class="w-full h-full object-contain">
                                    @else
                                        <span class="text-[10px] text-forest/60">No image</span>
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('product.show', $item['product']->slug ?? $item['product']->id) }}" class="font-display text-sm sm:text-base text-ink hover:text-forest block truncate mb-1">
                                        {{ $item['product']->name }}
                                    </a>
                                    <p class="text-xs text-ink/60 mb-3">${{ number_format($item['product']->price, 2) }} each</p>

                                    <!-- Quantity Form -->
                                    <div class="flex items-center gap-3">
                                        <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                                   class="w-14 border border-line rounded-sm px-2 py-1 text-xs text-center focus:outline-forest"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </div>
                                </div>

                                <!-- Line Total & Remove -->
                                <div class="text-right flex flex-col justify-between h-full self-stretch py-1">
                                    <p class="font-semibold text-sm sm:text-base text-ink">${{ number_format($item['lineTotal'], 2) }}</p>
                                    <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-ink/40 hover:text-clay transition-colors cursor-pointer">Remove</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right: Order Summary Box -->
                <div class="bg-white border border-line rounded-lg p-6 shadow-xs sticky top-8">
                    <h2 class="font-display text-lg text-ink mb-4 pb-3 border-b border-line">Order summary</h2>
                    
                    <div class="space-y-3 text-xs sm:text-sm mb-6">
                        <div class="flex justify-between text-ink/70">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="border-t border-line pt-3 flex justify-between font-semibold text-base text-ink">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="button" class="w-full bg-forest text-bone py-3 rounded-sm hover:bg-forestdark transition-colors text-xs uppercase tracking-wider font-medium cursor-pointer">
                        Proceed to Checkout
                    </button>

                    
                </div>

            </div>
        @endif
    </section>

@endsection