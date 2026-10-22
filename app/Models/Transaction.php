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
}
