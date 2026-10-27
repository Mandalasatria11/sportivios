<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'sub_category',
        'description',
        'price',
        'stock',
        'badge',
        'badge_type',
        'image',
        'sizes',
    ];

    /**
     * Relasi ke model Transaction (One-to-Many).
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Dapatkan label kategori yang rapi dan mudah dipahami.
     */
    public function getCategoryLabelAttribute(): string
    {
        $cat = strtolower($this->category ?? 'shoes');
        return match ($cat) {
            'shoes' => 'Footwear (Sepatu)',
            'apparel' => 'Apparel (Pakaian)',
            'accessories' => 'Accessories (Peralatan & Aksesoris)',
            default => ucfirst($cat),
        };
    }

    /**
     * Menentukan tipe sistem ukuran produk (shoe, apparel, atau none).
     */
    public function getSizeTypeAttribute(): string
    {
        $cat = strtolower($this->category ?? 'shoes');
        if ($cat === 'shoes') {
            return 'shoe';
        } elseif ($cat === 'apparel') {
            return 'apparel';
        }
        return 'none'; // accessories atau barang non-pakaian
    }

    /**
     * Apakah produk ini memerlukan pilihan banyak ukuran (sepatu/baju)
     * atau merupakan barang non-ukuran/All Size (botol minum, bola, tas, dll).
     */
    public function hasMultipleSizes(): bool
    {
        $cat = strtolower($this->category ?? 'shoes');
        if ($cat === 'accessories') {
            return false;
        }

        $sizes = $this->available_sizes;
        if (count($sizes) <= 1 && (in_array('All Size', $sizes) || in_array('One Size', $sizes))) {
            return false;
        }

        return count($sizes) > 1;
    }

    /**
     * Mengambil daftar ukuran produk secara dinamis.
     * Mendukung data custom dari database atau default pintar berdasarkan jenis kategori.
     */
    public function getAvailableSizesAttribute(): array
    {
        if (!empty($this->attributes['sizes'])) {
            $val = $this->attributes['sizes'];
            if (is_array($val)) {
                return $val;
            }
            $decoded = json_decode($val, true);
            if (is_array($decoded) && !empty($decoded)) {
                return $decoded;
            }
            if (is_string($val) && str_contains($val, ',')) {
                return array_values(array_filter(array_map('trim', explode(',', $val))));
            }
            if (is_string($val) && trim($val) !== '') {
                return [trim($val)];
            }
        }

        // Default pintar jika belum di-set di database
        $cat = strtolower($this->category ?? 'shoes');
        if ($cat === 'shoes') {
            return ['39', '40', '41', '42', '43', '44'];
        } elseif ($cat === 'apparel') {
            return ['S', 'M', 'L', 'XL', 'XXL'];
        } else {
            // Aksesoris / Non-wearables (botol, tas, bola, strap, dll)
            return ['All Size'];
        }
    }

    /**
     * Simpan array ukuran ke format JSON atau string rapi.
     */
    public function setSizesAttribute($value): void
    {
        if (is_array($value)) {
            $this->attributes['sizes'] = json_encode(array_values(array_filter($value)));
        } elseif (is_string($value) && str_contains($value, ',')) {
            $arr = array_values(array_filter(array_map('trim', explode(',', $value))));
            $this->attributes['sizes'] = json_encode($arr);
        } else {
            $this->attributes['sizes'] = $value;
        }
    }

    /**
     * Dapatkan ukuran default untuk cart / checkout awal.
     */
    public function getDefaultSizeAttribute(): string
    {
        $sizes = $this->available_sizes;
        return $sizes[0] ?? ($this->category === 'shoes' ? '42' : ($this->category === 'apparel' ? 'L' : 'All Size'));
    }

    /**
     * Judul spesifikasi ukuran di halaman detail produk.
     */
    public function getSizeTitleAttribute(): string
    {
        $cat = strtolower($this->category ?? 'shoes');
        return match ($cat) {
            'shoes' => 'Pilih Ukuran Sepatu (EU / Standard)',
            'apparel' => 'Pilih Ukuran Pakaian (Apparel Fit)',
            default => 'Spesifikasi Ukuran',
        };
    }
}
