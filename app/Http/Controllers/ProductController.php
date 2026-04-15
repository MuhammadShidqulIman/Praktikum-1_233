<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     * Menu ini diamankan oleh Gate 'export-product' di navigasi.
     */
    public function index()
    {
        // Mengambil data produk beserta user (owner) dengan pagination
        $products = Product::with('user')->paginate(10);

        return view('product.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('product.create', compact('users'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'qty'      => 'required|integer|min:0',
            'price'    => 'required|numeric|min:0',
            'user_id'  => 'required|exists:users,id',
        ]);

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Menampilkan detail produk.
     */
    public function show($id)
    {
        $product = Product::with('user')->findOrFail($id);
        return view('product.view', compact('product'));
    }

    /**
     * Menampilkan form edit produk.
     * PROTEKSI: Menggunakan Policy 'update'.
     */
    public function edit(Product $product)
    {
        // Melakukan verifikasi: Admin & Pemilik Data
        $this->authorize('update', $product);

        $users = User::orderBy('name')->get();
        return view('product.edit', compact('product', 'users'));
    }

    /**
     * Memperbarui data produk.
     * PROTEKSI: Menggunakan Policy 'update'.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Melakukan verifikasi: Admin & Pemilik Data
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'qty'      => 'required|integer|min:0',
            'price'    => 'required|numeric|min:0',
            'user_id'  => 'required|exists:users,id',
        ]);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Menghapus produk.
     * PROTEKSI: Menggunakan Policy 'delete'.
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Melakukan verifikasi: Admin & Pemilik Data
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}