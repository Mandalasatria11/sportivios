<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar seluruh pesanan & transaksi dengan filter status dan pencarian.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['product', 'user']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_code', 'like', "%{$search}%")
                  ->orWhere('buyer_name', 'like', "%{$search}%")
                  ->orWhere('buyer_phone', 'like', "%{$search}%")
                  ->orWhere('resi', 'like', "%{$search}%")
                  ->orWhereHas('product', function ($p) use ($search) {
                      $p->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Tampilkan rincian lengkap pesanan beserta histori tahapan tracking.
     */
    public function show($id)
    {
        $order = Transaction::with(['product', 'user'])->findOrFail($id);
        $timeline = $order->getTimeline();

        return view('admin.orders.show', compact('order', 'timeline'));
    }

    /**
     * Perbarui status pesanan, nomor resi pengiriman, dan kurir logistik.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Transaction::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:menunggu_pembayaran,diproses,dalam_perjalanan,selesai,dibatalkan',
            'resi' => 'nullable|string|max:100',
            'courier' => 'nullable|string|max:50',
        ]);

        // Jika status diubah ke 'dalam_perjalanan' dan resi belum diisi, generate otomatis jika kosong
        if ($validated['status'] === 'dalam_perjalanan' && empty($validated['resi'])) {
            $courierCode = strtoupper($order->courier ?? 'EXP');
            $validated['resi'] = 'SPV-' . $courierCode . '-' . rand(10000000, 99999999);
        }

        $order->update($validated);

        return back()->with('success', "Status dan data pengiriman pesanan #{$order->invoice_code} berhasil diperbarui.");
    }

    /**
     * Tambahkan tahapan / checkpoint baru ke riwayat perjalanan paket (Tracking Timeline).
     */
    public function addCheckpoint(Request $request, $id)
    {
        $order = Transaction::findOrFail($id);

        $validated = $request->validate([
            'checkpoint_title' => 'required|string|max:255',
            'checkpoint_desc' => 'nullable|string|max:500',
            'checkpoint_location' => 'nullable|string|max:255',
            'checkpoint_time' => 'nullable|string|max:100',
        ], [
            'checkpoint_title.required' => 'Judul tahapan / event pelacakan wajib diisi.',
        ]);

        $currentHistory = $order->getTimeline();

        // Jadikan checkpoint baru sebagai yang paling atas (terbaru dan aktif)
        $newCheckpoint = [
            'title' => $validated['checkpoint_title'],
            'desc' => $validated['checkpoint_desc'] ?? 'Status pelacakan telah diperbarui oleh sistem logistik Sportivios.',
            'location' => $validated['checkpoint_location'] ?? 'Fasilitas Hub Terkait',
            'time' => !empty($validated['checkpoint_time']) ? $validated['checkpoint_time'] : now()->format('d M Y • H:i'),
            'active' => true,
        ];

        // Nonaktifkan pulse pada checkpoint sebelumnya
        foreach ($currentHistory as &$item) {
            $item['active'] = false;
        }

        array_unshift($currentHistory, $newCheckpoint);

        $order->tracking_history = $currentHistory;
        $order->save();

        return back()->with('success', 'Checkpoint perjalanan paket baru berhasil ditambahkan ke timeline.');
    }

    /**
     * Hapus checkpoint tertentu dari riwayat perjalanan paket.
     */
    public function deleteCheckpoint(Request $request, $id, $index)
    {
        $order = Transaction::findOrFail($id);
        $currentHistory = $order->getTimeline();

        $index = (int)$index;
        if (isset($currentHistory[$index])) {
            unset($currentHistory[$index]);
            $currentHistory = array_values($currentHistory);

            if (!empty($currentHistory)) {
                $currentHistory[0]['active'] = true;
            }

            $order->tracking_history = $currentHistory;
            $order->save();

            return back()->with('success', 'Checkpoint perjalanan paket berhasil dihapus.');
        }

        return back()->with('error', 'Checkpoint tidak ditemukan.');
    }

    /**
     * Reset tahapan perjalanan paket kembali ke default status otomatis.
     */
    public function resetCheckpoints($id)
    {
        $order = Transaction::findOrFail($id);
        $order->notes = null;
        $order->save();

        return back()->with('success', 'Timeline perjalanan paket telah direset ke perhitungan otomatis status pesanan.');
    }
}
