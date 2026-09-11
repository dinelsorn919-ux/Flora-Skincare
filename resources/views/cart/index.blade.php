@extends('layouts.app')

@section('title', 'Your bag — Flora Skincare')

@section('content')

    <section class="max-w-4xl mx-auto px-6 py-14">
        <h1 class="font-display text-4xl text-ink mb-10">Your bag</h1>

        @if (empty($items))
            <p class="text-ink/60 mb-6">Your bag is empty.</p>
            <a href="{{ route('home') }}" class="text-forest hover:text-forestdark">Continue shopping</a>
        @else
            <div class="divide-y divide-line border-t border-b border-line">
                @foreach ($items as $item)
                    <div class="py-6 flex items-center gap-6">
                        <div class="w-24 h-28 border border-line rounded-sm overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1">
                            <a href="{{ route('product.show', $item['product']->slug) }}" class="font-display text-lg text-ink hover:text-forest">
                                {{ $item['product']->name }}
                            </a>
                            <p class="text-sm text-ink/60">${{ number_format($item['product']->price, 2) }} each</p>

                            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="flex items-center gap-3 mt-3">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" 
                                       class="w-16 border border-line rounded-sm px-2 py-1.5 text-sm"
                                       onchange="this.form.submit()">
                            </form>
                        </div>

                        <div class="text-right">
                            <p class="text-ink mb-2">${{ number_format($item['lineTotal'], 2) }}</p>
                            <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-ink/40 hover:text-clay">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-between pt-8">
                <a href="{{ route('home') }}" class="text-sm text-forest hover:text-forestdark">Continue shopping</a>
                <div class="text-right">
                    <p class="text-sm text-ink/60 mb-1">Subtotal</p>
                    <p class="font-display text-2xl text-ink">${{ number_format($total, 2) }}</p>
                </div>
            </div>

            <button class="w-full mt-8 bg-forest text-bone py-3.5 rounded-sm hover:bg-forestdark transition-colors">
                Checkout
            </button>
        @endif
    </section>

@endsection