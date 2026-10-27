<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     * Mengizinkan mass assignment untuk seluruh kolom transaksi.
     */
    protected $guarded = [];

    /**
     * Relasi ke model Product (One-to-Many Inverse / BelongsTo).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke model User (pemilik pesanan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Ambil riwayat checkpoint perjalanan paket dari kolom notes (JSON).
     */
    public function getTrackingHistoryAttribute(): array
    {
        if (empty($this->notes)) {
            return [];
        }

        $decoded = json_decode($this->notes, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Simpan riwayat checkpoint perjalanan paket ke kolom notes (JSON).
     */
    public function setTrackingHistoryAttribute($value): void
    {
        $this->attributes['notes'] = is_array($value)
            ? json_encode($value, JSON_UNESCAPED_UNICODE)
            : $value;
    }

    /**
     * Dapatkan daftar tahapan / perjalanan paket secara dinamis.
     * Jika admin telah menambahkan checkpoint kustom, tampilkan checkpoint tersebut.
     * Jika belum, bangun timeline dinamis berdasarkan status terkini dan waktu order.
     */
    public function getTimeline(): array
    {
        $customCheckpoints = $this->tracking_history;

        if (!empty($customCheckpoints)) {
            return $customCheckpoints;
        }

        $status = $this->status ?? 'diproses';
        $courierName = $this->courier ?? 'JNE';
        $resiCode = $this->resi ?? 'Menunggu No. Resi';
        $created = $this->created_at ?? now();
        $updated = $this->updated_at ?? now();

        $timeline = [];

        // 1. Jika pesanan selesai / terkirim
        if ($status === 'selesai') {
            $timeline[] = [
                'title' => 'Paket Telah Tiba & Diterima',
                'desc' => "Paket telah diterima dengan baik oleh penerima ({$this->buyer_name}) di alamat tujuan.",
                'location' => 'Alamat Penerima',
                'time' => $updated->format('d M Y • H:i'),
                'active' => true,
            ];
            $timeline[] = [
                'title' => 'Dalam Pengantaran oleh Kurir ' . $courierName,
                'desc' => "Kurir sedang mengantar paket dengan No. Resi: {$resiCode} ke lokasi alamat tujuan.",
                'location' => 'Area Domisili Penerima',
                'time' => $updated->copy()->subHours(4)->format('d M Y • H:i'),
                'active' => false,
            ];
            $timeline[] = [
                'title' => 'Tiba di Sorting Hub Logistik',
                'desc' => 'Paket telah lolos pemindaian resi dan diproses menuju hub distribusi terdekat.',
                'location' => 'Hub Distribusi Pusat',
                'time' => $created->copy()->addHours(6)->format('d M Y • H:i'),
                'active' => false,
            ];
            $timeline[] = [
                'title' => "Diserahkan ke Kurir Ekspedisi ({$courierName})",
                'desc' => "Paket dijemput oleh armada logistik {$courierName} dari Fulfillment Hub Sportivios.",
                'location' => 'Sportivios Dispatch Facility',
                'time' => $created->copy()->addHours(2)->format('d M Y • H:i'),
                'active' => false,
            ];
            $timeline[] = [
                'title' => 'Pesanan Berhasil Dibuat & Diproses',
                'desc' => 'Pesanan terverifikasi dan produk lolos pemeriksaan mutu (Quality Control).',
                'location' => 'Gudang Pusat Sportivios',
                'time' => $created->format('d M Y • H:i'),
                'active' => false,
            ];
        }
        // 2. Jika dalam perjalanan
        elseif ($status === 'dalam_perjalanan') {
            $timeline[] = [
                'title' => 'Dalam Perjalanan Pengantaran oleh Kurir ' . $courierName,
                'desc' => !empty($this->resi)
                    ? "Kurir sedang dalam perjalanan menuju alamat penerima (No. Resi: {$this->resi})."
                    : 'Paket sedang dibawa armada logistik menuju kota tujuan.',
                'location' => 'Transit Hub / Dalam Perjalanan',
                'time' => $updated->format('d M Y • H:i'),
                'active' => true,
            ];
            $timeline[] = [
                'title' => 'Tiba di Sorting Hub Logistik',
                'desc' => 'Paket telah lolos pemindaian resi dan diteruskan ke fasilitas distribusi kota tujuan.',
                'location' => 'Fasilitas Sortir Logistik',
                'time' => $created->copy()->addHours(4)->format('d M Y • H:i'),
                'active' => false,
            ];
            $timeline[] = [
                'title' => "Diserahkan ke Kurir Ekspedisi ({$courierName})",
                'desc' => 'Paket telah diserahkan dan No. Resi diterbitkan secara resmi oleh sistem.',
                'location' => 'Sportivios Fulfillment Center',
                'time' => $created->copy()->addHours(2)->format('d M Y • H:i'),
                'active' => false,
            ];
            $timeline[] = [
                'title' => 'Pesanan Terverifikasi & Dikemas',
                'desc' => 'Produk telah melalui Quality Control dan dikemas menggunakan segel pengaman.',
                'location' => 'Gudang Pusat Sportivios',
                'time' => $created->format('d M Y • H:i'),
                'active' => false,
            ];
        }
        // 3. Jika dibatalkan
        elseif ($status === 'dibatalkan') {
            $timeline[] = [
                'title' => 'Pesanan Dibatalkan',
                'desc' => 'Transaksi telah dibatalkan oleh pihak pembeli atau administrator toko.',
                'location' => 'Sistem Sportivios',
                'time' => $updated->format('d M Y • H:i'),
                'active' => true,
            ];
            $timeline[] = [
                'title' => 'Pesanan Masuk ke Sistem',
                'desc' => 'Invoice pembayaran dibuat oleh sistem.',
                'location' => 'Checkout Sportivios',
                'time' => $created->format('d M Y • H:i'),
                'active' => false,
            ];
        }
        // 4. Default: Sedang diproses
        else {
            $timeline[] = [
                'title' => 'Pesanan Sedang Diproses & Dikemas',
                'desc' => 'Tim gudang Sportivios sedang menyiapkan barang, verifikasi ukuran, dan packaging aman.',
                'location' => 'Sportivios Warehouse Jakarta',
                'time' => $updated->format('d M Y • H:i'),
                'active' => true,
            ];
            $timeline[] = [
                'title' => 'Pembayaran Terkonfirmasi',
                'desc' => 'Pembayaran telah diverifikasi secara instan. Pesanan masuk ke antrean packaging.',
                'location' => 'Sistem Pembayaran Sportivios',
                'time' => $created->format('d M Y • H:i'),
                'active' => false,
            ];
        }

        return $timeline;
    }
}
