<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang belanja.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        // Jika keranjang belum pernah diisi, kita bisa inisialisasi dengan 1 produk contoh dari DB agar tampilan tidak kosong saat pertama dibuka
        if (empty($cart) && !session()->has('cart_initialized')) {
            $sampleProduct = Product::first();
            if ($sampleProduct) {
                $key = $sampleProduct->id . '_42';
                $cart[$key] = [
                    'key' => $key,
                    'product_id' => $sampleProduct->id,
                    'name' => $sampleProduct->name,
                    'price' => (float)$sampleProduct->price,
                    'quantity' => 1,
                    'size' => '42',
                    'color' => 'Black / Cyan',
                    'category_label' => ucfirst($sampleProduct->category ?? 'Footwear'),
                    'image' => asset($sampleProduct->image ?? 'images/products/shoe.jpg'),
                ];
                session()->put('cart', $cart);
                session()->put('cart_initialized', true);
            }
        }

        $subtotal = 0;
        $totalItems = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
            $totalItems += $item['quantity'];
        }

        $tax = 0; // Bebas pajak atau include dalam harga
        $shipping = 0; // Free shipping untuk seluruh Indonesia
        $total = $subtotal;

        return view('cart.index', [
            'cartItems' => $cart,
            'subtotal' => $subtotal,
            'totalItems' => $totalItems,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }

    /**
     * Tambahkan produk ke keranjang belanja.
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        $size = $request->input('size', '42');
        $color = $request->input('color', 'Default');
        $quantity = max(1, (int)$request->input('quantity', 1));

        $cart = session()->get('cart', []);
        $itemKey = $product->id . '_' . $size;

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $quantity;
        } else {
            $cart[$itemKey] = [
                'key' => $itemKey,
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => (float)$product->price,
                'quantity' => $quantity,
                'size' => $size,
                'color' => $color,
                'category_label' => ucfirst($product->category ?? 'Footwear'),
                'image' => asset($product->image ?? 'images/products/shoe.jpg'),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', "{$product->name} berhasil ditambahkan ke keranjang belanja.");
    }

    /**
     * Perbarui jumlah (quantity) produk dalam keranjang.
     */
    public function update(Request $request, $key = null)
    {
        $key = $key ?? $request->input('key');
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $action = $request->input('action');
            if ($action === 'increase') {
                $cart[$key]['quantity'] += 1;
            } elseif ($action === 'decrease') {
                $cart[$key]['quantity'] -= 1;
                if ($cart[$key]['quantity'] <= 0) {
                    unset($cart[$key]);
                }
            } elseif ($request->has('quantity')) {
                $qty = (int)$request->input('quantity');
                if ($qty <= 0) {
                    unset($cart[$key]);
                } else {
                    $cart[$key]['quantity'] = $qty;
                }
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Keranjang belanja berhasil diperbarui.');
    }

    /**
     * Hapus satu item dari keranjang.
     */
    public function remove(Request $request, $key = null)
    {
        $key = $key ?? $request->input('key');
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    /**
     * Kosongkan seluruh keranjang.
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Keranjang belanja telah dikosongkan.');
    }
}
