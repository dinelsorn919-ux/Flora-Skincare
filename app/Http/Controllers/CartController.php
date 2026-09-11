<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        [$items, $total] = $this->cartWithTotals();

        return view('cart.index', [
            'items' => $items,
            'total' => $total,
            'categories' => Product::categories(),
        ]);
    }

    public function add(Request $request, Product $product)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        $cart = Session::get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $quantity;
        Session::put('cart', $cart);

        return back()->with('status', $product->name.' added to your Cart.');
    }

    public function update(Request $request, Product $product)
    {
        $quantity = (int) $request->input('quantity', 1);
        $cart = Session::get('cart', []);

        if ($quantity <= 0) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = $quantity;
        }

        Session::put('cart', $cart);

        return back()->with('status', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $cart = Session::get('cart', []);
        unset($cart[$product->id]);
        Session::put('cart', $cart);

        return back()->with('status', $product->name.' removed from your Cart.');
    }

    private function cartWithTotals(): array
    {
        $cart = Session::get('cart', []);
        $items = [];
        $total = 0;

        if (! empty($cart)) {
            $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

            foreach ($cart as $productId => $quantity) {
                $product = $products->get($productId);
                if (! $product) {
                    continue;
                }
                $lineTotal = $product->price * $quantity;
                $total += $lineTotal;

                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'lineTotal' => $lineTotal,
                ];
            }
        }

        return [$items, $total];
    }
}