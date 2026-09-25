@extends('admin.layout')

@section('title', 'Products — Admin')

@section('content')
    <div class="w-full px-6 py-6">
        
        <div class="flex items-center justify-between mb-6">
            <h1 class="font-display text-2xl text-ink">Products</h1>
            <a href="{{ route('admin.products.create') }}" class="bg-forest text-bone text-xs px-4 py-2 rounded-sm hover:bg-forestdark transition-colors">
                Add product
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 text-xs text-forest border border-forest/30 bg-forest/5 rounded-sm px-4 py-2.5">
                {{ session('success') }}
            </div>
        @endif

        <div class="border border-line rounded-sm overflow-hidden bg-white shadow-xs">
            <table class="w-full text-xs">
                <thead class="bg-forest/5 text-left text-ink/60 border-b border-line">
                    <tr>
                        <th class="px-4 py-3 font-medium">Product</th>
                        <th class="px-4 py-3 font-medium">Category</th>
                        <th class="px-4 py-3 font-medium">Price</th>
                        <th class="px-4 py-3 font-medium">Stock</th>
                        <th class="px-4 py-3 font-medium">Featured</th>
                        <th class="px-4 py-3 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($products as $product)
                        <tr class="hover:bg-forest/[0.02] transition-colors">
                            <td class="px-4 py-3 flex items-center gap-3">
                                @if($product->image)
                                    <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-9 h-9 object-cover rounded-sm border border-line flex-shrink-0">
                                @endif
                                <span class="font-medium text-ink">{{ $product->name }}</span>
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
                                <div class="inline-flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-forest/10 text-forest text-[11px] px-2.5 py-1 rounded-sm font-medium hover:bg-forest/20 transition-all">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete {{ addslashes($product->name) }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-clay/10 text-clay text-[11px] px-2.5 py-1 rounded-sm font-medium hover:bg-clay/20 transition-all cursor-pointer">
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

       <!-- Pagination Section -->
        <div class="mt-6">
            {{ $products->onEachSide(1)->links('pagination::tailwind') }}
        </div>
        
    </div>
@endsection