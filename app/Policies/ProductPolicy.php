<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Logika untuk Update: Harus Admin DAN Pemilik Data
     */
    public function update(User $user, Product $product): bool
    {
        // Cek apakah dia admin DAN apakah user_id di produk cocok dengan id user
        return $user->role === 'admin' && $user->id === $product->user_id;
    }

    /**
     * Logika untuk Delete: Harus Admin DAN Pemilik Data
     */
    public function delete(User $user, Product $product): bool
    {
        // Logikanya sama dengan update
        return $user->role === 'admin' && $user->id === $product->user_id;
    }
}