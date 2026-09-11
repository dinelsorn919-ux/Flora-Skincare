@extends('layouts.app')

@section('title', 'Search Results — Flora Skincare')

@section('content')

    <section class="max-w-6xl mx-auto px-6 pb-20">
        @if ($products->isEmpty())
            <p class="text-ink/60">No products found matching your search.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($products as $product)
                    @include('storefront.partials.product-card', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-12">
                {{ $products->appends(['q' => $query])->links() }}
            </div>
        @endif
    </section>

@endsection