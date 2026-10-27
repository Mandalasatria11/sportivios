<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar seluruh produk dengan pencarian dan filter kategori.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('sub_category', 'like', "%{$search}%");
            });
        }

        if ($cat = $request->input('category')) {
            $query->where('category', $cat);
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Tampilkan formulir tambah produk baru.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Simpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:shoes,apparel,accessories',
            'sub_category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sizes' => 'nullable|string|max:500',
            'badge' => 'nullable|string|max:50',
            'badge_type' => 'nullable|in:cyan,red',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'category.required' => 'Kategori produk wajib dipilih.',
            'price.required' => 'Harga produk wajib diisi.',
            'stock.required' => 'Jumlah stok awal wajib diisi.',
        ]);

        $imagePath = 'images/products/shoe.jpg';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug($validated['name']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $fileName);
            $imagePath = 'images/products/' . $fileName;
        }

        $sizes = $request->input('sizes');
        if ($validated['category'] === 'accessories' && empty($sizes)) {
            $sizes = 'All Size';
        }

        Product::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'sub_category' => $validated['sub_category'] ?? ucfirst($validated['category']),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'sizes' => $sizes,
            'badge' => $validated['badge'] ?? null,
            'badge_type' => $validated['badge_type'] ?? 'cyan',
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan formulir ubah produk.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Perbarui data produk di database.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:shoes,apparel,accessories',
            'sub_category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sizes' => 'nullable|string|max:500',
            'badge' => 'nullable|string|max:50',
            'badge_type' => 'nullable|in:cyan,red',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug($validated['name']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $fileName);
            $validated['image'] = 'images/products/' . $fileName;
        }

        if ($validated['category'] === 'accessories' && empty($validated['sizes'])) {
            $validated['sizes'] = 'All Size';
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Hapus produk dari database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', "Produk \"{$product->name}\" berhasil dihapus.");
    }
}
