<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function home()
{
    // កែប្រែត្រង់នេះ ដើម្បីឱ្យអថេរ $products ទាញយកតែផលិតផល Featured
    $products = Product::where('is_featured', 1)->latest()->paginate(30);
    
    // ឬប្រសិនបើអ្នកនៅតែចង់រក្សាទុក $featured ទុកប្រើប្រាស់ផ្សេង
    $featured = Product::where('is_featured', 1)->latest()->take(30)->get();

    return view('storefront.home', compact('products', 'featured'));
}

  public function category($slug)
{
    $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
    $products = \App\Models\Product::where('category', $category->name)->paginate(12);
    $categoryLabel = $category->name;

    return view('storefront.category', compact('products', 'categoryLabel'));
}
   public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();

        $related = Product::inCategory($product->category)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('storefront.show', [
            'product' => $product,
            'related' => $related,
            'categories' => Product::categories(),
        ]);
    }
    public function search(Request $request)
    {
    $query = $request->input('q');
    
    $products = \App\Models\Product::where('name', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%")
        ->paginate(12);

    return view('storefront.search', compact('products', 'query'));
}
}
