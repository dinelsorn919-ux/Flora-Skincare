<div class="space-y-4">
    <!-- Row 1: Name, Category, Stock -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
        <div class="md:col-span-6">
            <label for="name" class="block text-[11px] text-ink/70 mb-1 font-medium">Product Name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required placeholder="e.g. Ceramide Repair Cream"
                class="w-full border border-line rounded-lg px-3.5 py-2 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
        </div>
    <!-----Category------>
       <div class="md:col-span-4">
    <label for="category" class="block text-[11px] text-ink/70 mb-1 font-medium">Category</label>
    <select id="category" name="category" required
        class="w-full border border-line rounded-lg px-3.5 py-2 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
        <option value="">Select category</option>
        @foreach(\App\Models\Category::all() as $cat)
            <option value="{{ $cat->name }}" {{ old('category', $product->category ?? '') == $cat->name ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

        <div class="md:col-span-2">
            <label for="stock" class="block text-[11px] text-ink/70 mb-1 font-medium">Stock</label>
            <input id="stock" type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}" min="0" placeholder="30"
                class="w-full border border-line rounded-lg px-3.5 py-2 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
        </div>
    </div>

    <!-- Row 2: Price, Compare Price, Short Description -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
        <div class="md:col-span-2">
            <label for="price" class="block text-[11px] text-ink/70 mb-1 font-medium">Price ($)</label>
            <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" required placeholder="42.00"
                class="w-full border border-line rounded-lg px-3.5 py-2 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
        </div>

        <div class="md:col-span-2">
            <label for="compare_price" class="block text-[11px] text-ink/70 mb-1 font-medium">Compare Price ($)</label>
            <input id="compare_price" type="number" step="0.01" name="compare_price" value="{{ old('compare_price', $product->compare_price ?? '') }}" placeholder="52.00"
                class="w-full border border-line rounded-lg px-3.5 py-2 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
        </div>

        <div class="md:col-span-8">
            <label for="short_description" class="block text-[11px] text-ink/70 mb-1 font-medium">Short Description</label>
            <input id="short_description" type="text" name="short_description" value="{{ old('short_description', $product->short_description ?? '') }}" placeholder="Ceramide-rich overnight repair"
                class="w-full border border-line rounded-lg px-3.5 py-2 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
        </div>
    </div>

    <!-- Row 3: Full Description (Short Height) -->
    <div>
        <label for="description" class="block text-[11px] text-ink/70 mb-1 font-medium">Full Description</label>
        <textarea id="description" name="description" rows="2" placeholder="A rich, ceramide-and-squalane cream..."
            class="w-full border border-line rounded-lg px-3.5 py-2 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all resize-none">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <!-- Row 4: Image Handling & Feature Checkbox -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center pt-2 border-t border-line">
        @if(isset($product) && $product->image)
            <div class="md:col-span-2 flex items-center gap-2">
                <div class="w-8 h-8 rounded border border-line overflow-hidden bg-bone/30 flex-shrink-0">
                    <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="" class="w-full h-full object-cover">
                </div>
                <span class="text-[10px] text-ink/60">Current image</span>
            </div>
        @endif

        <div class="{{ isset($product) && $product->image ? 'md:col-span-4' : 'md:col-span-6' }}">
            <label for="image_url" class="block text-[11px] text-ink/70 mb-1 font-medium">Image URL</label>
            <input id="image_url" type="url" name="image_url" value="{{ old('image_url', (isset($product) && filter_var($product->image, FILTER_VALIDATE_URL)) ? $product->image : '') }}" placeholder="https://..."
                class="w-full border border-line rounded-lg px-3.5 py-1.5 text-xs bg-bone/30 focus:outline-none focus:border-forest focus:bg-white transition-all">
        </div>

        <div class="md:col-span-4">
            <label for="image_upload" class="block text-[11px] text-ink/70 mb-1 font-medium">Upload File</label>
            <input id="image_upload" type="file" name="image_upload"
                class="w-full text-[11px] text-ink/60 file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:text-[11px] file:font-medium file:bg-bone file:text-ink hover:file:bg-bone/80 transition-all border border-line rounded-lg bg-bone/30">
        </div>

        <div class="md:col-span-2 flex items-center h-full pt-5">
            <label class="flex items-center gap-2 text-xs text-ink/80 cursor-pointer font-medium">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }} class="rounded border-line text-forest focus:ring-forest w-3.5 h-3.5">
                Feature
            </label>
        </div>
    </div>

    <!-- Footer Actions -->
    <div class="flex items-center justify-end gap-3 pt-3 border-t border-line">
        <a href="{{ route('admin.products.index') }}" class="text-xs text-ink/60 hover:text-ink px-3 py-1.5">Cancel</a>
        <button type="submit" class="bg-forest text-bone py-2.5 px-5 rounded-lg hover:bg-forestdark transition-all text-xs font-medium shadow-sm">
            {{ isset($product) ? 'Update Product' : 'Save Product' }}
        </button>
    </div>
</div>