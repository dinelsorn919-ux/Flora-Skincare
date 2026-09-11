@extends('admin.layout')

@section('title', 'Products — Admin')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="font-display text-3xl text-ink">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-forest text-bone text-sm px-5 py-2.5 rounded-sm hover:bg-forestdark transition-colors">
            Add product
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 text-xs text-forest border border-forest/30 bg-forest/5 rounded-sm px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="border border-line rounded-sm overflow-hidden bg-white shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-forest/5 text-left text-ink/60">
                <tr>
                    <th class="px-4 py-3 font-normal">Product</th>
                    <th class="px-4 py-3 font-normal">Category</th>
                    <th class="px-4 py-3 font-normal">Price</th>
                    <th class="px-4 py-3 font-normal">Stock</th>
                    <th class="px-4 py-3 font-normal">Featured</th>
                    <th class="px-4 py-3 font-normal text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-line">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-4 py-3 flex items-center gap-3">
                            @if($product->image)
                                <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded-lg border border-line">
                            @endif
                            {{ $product->name }}
                        </td>
                        <td class="px-4 py-3 text-ink/70">
                            @if(method_exists(\App\Models\Product::class, 'categories') && isset(\App\Models\Product::categories()[$product->category]))
                                {{ \App\Models\Product::categories()[$product->category] }}
                            @else
                                {{ optional($product->categoryRelation)->name ?? $product->category }}
                            @endif
                        </td>
                        <td class="px-4 py-3 text-ink/70">${{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3 text-ink/70">{{ $product->stock }}</td>
                        <td class="px-4 py-3 text-ink/70">{{ $product->is_featured ? 'Yes' : '—' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="bg-forest/10 text-forest text-xs px-3 py-1.5 rounded-lg font-medium hover:bg-forest/20 transition-all">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete {{ addslashes($product->name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-clay/10 text-clay text-xs px-3 py-1.5 rounded-lg font-medium hover:bg-clay/20 transition-all">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-ink/50">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection