<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
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
            $destination = public_path('assets/images');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $fileName);
            $imagePath = $fileName;
        }

        $sizes = $request->input('sizes');
        if ($validated['category'] === 'accessories' && empty($sizes)) {
            $sizes = 'All Size';
        }

        $productData = [
            'name' => $validated['name'],
            'category' => $validated['category'],
            'sub_category' => $validated['sub_category'] ?? ucfirst($validated['category']),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'badge' => $validated['badge'] ?? null,
            'badge_type' => $validated['badge_type'] ?? 'cyan',
            'image' => $imagePath,
        ];

        // Pastikan kolom sizes hanya disimpan jika tabel products memilikinya
        if (Schema::hasColumn('products', 'sizes')) {
            $productData['sizes'] = $sizes;
        }

        Product::create($productData);

        return redirect('/admin/products')->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan formulir ubah produk.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        if (view()->exists('admin.edit_product')) {
            return view('admin.edit_product', compact('product'));
        }

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Perbarui data produk di database (Fungsi updateProduct).
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validasi Input (Aturan validasi gambar WAJIB bersifat opsional)
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

        // 2. Conditional Image Upload & Cleanup
        if ($request->hasFile('image')) {
            // Hapus gambar fisik lama dari server jika ada
            if (!empty($product->image)) {
                $oldAssetPath = public_path('assets/images/' . $product->image);
                if (file_exists($oldAssetPath) && is_file($oldAssetPath)) {
                    File::delete($oldAssetPath);
                }

                $oldDirectPath = public_path($product->image);
                $protectedImages = ['shoe.jpg', 'shoe-action.jpg', 'shoe-sole.jpg', 'shoe-heel.jpg', 'tee.jpg', 'tights.jpg', 'jacket.jpg', 'flask.jpg', 'gloves.png', 'shoe.png'];
                if (file_exists($oldDirectPath) && is_file($oldDirectPath) && !in_array(basename($oldDirectPath), $protectedImages)) {
                    File::delete($oldDirectPath);
                }
            }

            // Simpan gambar baru ke folder public/assets/images/ dengan nama unik
            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug($validated['name']) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('assets/images');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $fileName);

            // Masukkan nama file baru ke dalam data yang akan di-update
            $validated['image'] = $fileName;
        } else {
            // Pertahankan nama file gambar lama (jangan ubah kolom gambar di database)
            unset($validated['image']);
        }

        if ($validated['category'] === 'accessories' && empty($validated['sizes'])) {
            $validated['sizes'] = 'All Size';
        }

        // Hapus sizes dari array update jika kolom belum ada di database
        if (!Schema::hasColumn('products', 'sizes')) {
            unset($validated['sizes']);
        }

        // 3. Simpan perubahan ke database dan redirect kembali ke /admin/products dengan session flash
        $product->update($validated);

        return redirect('/admin/products')->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Alias method untuk RESTful update.
     */
    public function update(Request $request, $id)
    {
        return $this->updateProduct($request, $id);
    }

    /**
     * Hapus produk dari database (Fungsi deleteProduct).
     */
    public function deleteProduct($id)
    {
        // 1. Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        // 2. Sebelum menghapus data dari database, hapus file gambar fisik dari folder server
        if (!empty($product->image)) {
            $assetPath = public_path('assets/images/' . $product->image);
            if (file_exists($assetPath) && is_file($assetPath)) {
                File::delete($assetPath);
            }

            $directPath = public_path($product->image);
            $protectedImages = ['shoe.jpg', 'shoe-action.jpg', 'shoe-sole.jpg', 'shoe-heel.jpg', 'tee.jpg', 'tights.jpg', 'jacket.jpg', 'flask.jpg', 'gloves.png', 'shoe.png'];
            if (file_exists($directPath) && is_file($directPath) && !in_array(basename($directPath), $protectedImages)) {
                File::delete($directPath);
            }
        }

        $productName = $product->name;

        // 3. Jalankan $product->delete() untuk menghapus record dari MySQL
        $product->delete();

        // 4. Lakukan redirect kembali ke /admin/products dengan flash message sukses
        return redirect('/admin/products')->with('success', "Produk \"{$productName}\" berhasil dihapus.");
    }

    /**
     * Alias method untuk RESTful destroy.
     */
    public function destroy($id)
    {
        return $this->deleteProduct($id);
    }
}
