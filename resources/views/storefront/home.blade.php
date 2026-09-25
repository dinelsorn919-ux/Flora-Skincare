@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-6 py-12 md:py-20 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h1 class="font-display text-4xl md:text-6xl leading-[1.05] text-ink">
                Skin care that reads the label so you don't have to.
            </h1>
            <p class="mt-6 text-ink/70 max-w-md">
                Fewer ingredients, chosen for a reason. Flora Skincare makes four things well: a cleanser, a serum, a cream, and the SPF you'll actually reapply.
            </p>
            <a href="{{ route('category', 'serums') }}" class="inline-block mt-8 bg-forest text-bone px-6 py-3 rounded-sm hover:bg-forestdark transition-colors">
                Shop the collection
            </a>
        </div>
        
        <!-- Icon Logo Picture -->
        <div class="w-full max-w-lg mx-auto bg-forest/5 border border-line rounded-sm overflow-hidden flex items-center justify-center p-2">
            <img src="{{ asset('image/f2.PNG') }}" alt="Flora Skincare collection" class="w-full h-auto object-contain">
        </div>
    </section>

    <!-- Show Category Section -->
    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="text-center mb-8">
            <h2 class="font-display text-2xl text-ink">Shop by Category</h2>
        </div>
        
        <div class="flex flex-wrap items-center justify-center gap-3">
            @foreach(\App\Models\Category::all() as $category)
                <a href="{{ route('category', $category->slug ?? $category->name) }}" class="border border-line rounded-full px-5 py-2.5 text-xs font-medium text-ink bg-white hover:border-forest hover:text-forest transition-all shadow-sm">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </section>

    <!-- Best Seller / Product Grid Section -->
    <section class="max-w-6xl mx-auto px-6 py-12">
        <h2 class="font-display text-2xl md:text-3xl text-ink mb-6">Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 justify-start mb-12">
            @foreach ($products as $product)
                @include('storefront.partials.product-card', ['product' => $product])
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </section>

   

@endsection