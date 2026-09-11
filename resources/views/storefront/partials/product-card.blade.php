@php
    $imageUrl = str_starts_with($product->image ?? '', 'http') 
        ? $product->image 
        : ($product->image ? asset('storage/' . ltrim($product->image ?? '', '/storage/')) : null);
@endphp

<div x-data="{ openModal: false }" class="group flex flex-col items-center text-center border border-line rounded-md p-3 bg-white hover:border-forest transition-all relative w-full">
    
    <!-- Thumbnail: Click to open modal -->
    <div @click.prevent="openModal = true" class="w-full h-48 border border-line rounded-sm bg-white p-2 flex items-center justify-center mb-3 overflow-hidden cursor-pointer">
        @if(!empty($product->image))
            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
        @else
            <div class="w-full h-full flex items-center justify-center bg-forest/5 text-forest/60 text-xs">
                No image
            </div>
        @endif
    </div>

    <!-- Details -->
    <div class="flex-1 flex flex-col items-center w-full">
        <button type="button" @click.prevent="openModal = true" class="font-display text-xs font-medium text-ink hover:text-forest mb-1 line-clamp-1 bg-transparent border-none cursor-pointer text-center w-full">
            {{ $product->name }}
        </button>
        <p class="text-[11px] text-ink/60 mb-2 line-clamp-1">{{ $product->short_description ?? $product->description }}</p>
        
        <div class="flex items-center justify-center gap-2 mb-3">
            <span class="text-xs font-semibold text-ink">${{ number_format($product->price, 2) }}</span>
            @if($product->compare_price && $product->compare_price > $product->price)
                <span class="text-[10px] text-ink/40 line-through">${{ number_format($product->compare_price, 2) }}</span>
            @endif
        </div>
    </div>

    <!-- Add to Cart Form -->
    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-auto w-full">
        @csrf
        <button type="submit" class="w-full bg-forest text-bone text-[11px] py-1.5 rounded-sm hover:bg-forestdark transition-colors">
            Add to Cart
        </button>
    </form>

    <!-- Quick View Modal Pop-up -->
    <div x-show="openModal" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-ink/40 backdrop-blur-xs p-4"
         x-transition.opacity>
        
        <div @click.away="openModal = false" class="bg-white rounded-lg max-w-2xl w-full p-6 relative shadow-2xl text-left flex flex-col md:flex-row gap-6">
            
            <!-- Close Button -->
            <button type="button" @click="openModal = false" class="absolute top-4 right-4 text-ink/60 hover:text-ink text-lg font-bold cursor-pointer">
                ✕
            </button>

            <!-- Modal Left: Image -->
            <div class="w-full md:w-1/2 h-80 border border-line rounded-sm bg-white p-4 flex items-center justify-center overflow-hidden">
                @if(!empty($product->image))
                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                @else
                    <span class="text-xs text-forest/60">No image</span>
                @endif
            </div>

            <!-- Modal Right: Content -->
            <div class="w-full md:w-1/2 flex flex-col justify-between">
                <div>
                    <h2 class="font-display text-xl text-ink mb-1">{{ $product->name }}</h2>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-sm font-semibold text-ink">${{ number_format($product->price, 2) }}</span>
                        @if($product->compare_price && $product->compare_price > $product->price)
                            <span class="text-xs text-ink/40 line-through">${{ number_format($product->compare_price, 2) }}</span>
                        @endif
                    </div>
                    <p class="text-xs text-ink/70 leading-relaxed mb-6">{{ $product->description }}</p>
                </div>

                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-forest text-bone text-xs py-3 rounded-sm hover:bg-forestdark transition-colors">
                        Add to cart
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>