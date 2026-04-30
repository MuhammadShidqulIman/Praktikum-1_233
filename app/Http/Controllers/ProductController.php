<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Kategori;
use App\Models\User; // Wajib dipanggil untuk dropdown Owner
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        // Mengambil semua produk beserta data relasi kategorinya
        $products = Product::with('kategori')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        // Ambil semua data kategori dan user untuk dropdown
        $categories = Kategori::all();
        $users = User::all();
        
        return view('product.create', compact('categories', 'users'));
    }

    /**
     * Menyimpan data produk baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name'        => 'required|string|max:255',
            'qty'         => 'required|integer',
            'price'       => 'required|numeric',
            'user_id'     => 'required|exists:users,id',      // Sesuai dengan name="user_id" di view kamu
            'category_id' => 'required|exists:kategoris,id'   // Sesuai dengan name="category_id"
        ]);

        Product::create($request->all());

        return redirect()->route('product.index')->with('success', 'Product added successfully!');
    }

    /**
     * Menampilkan detail satu produk.
     */
    public function show($id)
    {
        // Mencari produk berdasarkan ID, kalau tidak ketemu akan otomatis error 404
        $product = Product::findOrFail($id);
        
        return view('product.view', compact('product'));
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit($id)
    {
        // Mencari produk berdasarkan ID
        $product = Product::findOrFail($id);
        
        // Ambil semua data kategori dan user untuk dropdown edit
        $categories = Kategori::all();
        $users = User::all();
        
        return view('product.edit', compact('product', 'categories', 'users'));
    }

    /**
     * Memperbarui data produk di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'qty'         => 'required|integer',
            'price'       => 'required|numeric',
            'user_id'     => 'required|exists:users,id',
            'category_id' => 'required|exists:kategoris,id'
        ]);

        // Mencari produk lalu di-update
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Menghapus produk.
     */
    public function destroy($id)
    {
        // Mencari produk lalu dihapus
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}