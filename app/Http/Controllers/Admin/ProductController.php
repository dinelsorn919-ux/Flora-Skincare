<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
   {
    
    $products = Product::latest()->paginate(10);

    return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Product::categories(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = Str::slug($data['name']);
        $data['image'] = $this->resolveImage($request);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('status', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Product::categories(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request);

        $data['slug'] = Str::slug($data['name']);

        if ($newImage = $this->resolveImage($request)) {
            // delete old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $newImage;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        // delete picture in  Storage when you delete Product
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Product deleted.');
    }

    private function validated(Request $request): array
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'exists:categories,name'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'image_url' => ['nullable', 'url'],
            'image_upload' => ['nullable', 'image', 'max:4096'],
        ]);

        return $request->only([
            'name', 'category', 'short_description', 'description',
            'price', 'compare_price', 'stock',
        ]) + ['is_featured' => $request->boolean('is_featured')];
    }

    private function resolveImage(Request $request): ?string
    {
        if ($request->hasFile('image_upload')) {
            return $request->file('image_upload')->store('products', 'public');
        }

        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return null;
    }
}