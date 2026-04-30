<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori beserta TOTAL PRODUCT.
     */
    public function index()
    {
        // Menggunakan withCount('products') untuk otomatis menghitung jumlah produk terkait[cite: 1]
        $categories = Kategori::withCount('products')->get();
        
        return view('kategori.index', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input, nama kategori harus diisi dan unik[cite: 1]
        $request->validate([
            'name' => 'required|unique:kategoris,name|max:255',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Category added successfully!');
    }

    /**
     * Menampilkan detail satu kategori.
     * (Terhubung dengan view.blade.php)
     */
    public function show(Kategori $kategori)
    {
        return view('kategori.view', compact('kategori'));
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Memperbarui data kategori ke database.
     */
    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input, nama kategori harus unik kecuali untuk ID kategori ini sendiri
        $request->validate([
            'name' => 'required|max:255|unique:kategoris,name,' . $kategori->id,
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        
        return redirect()->route('kategori.index')->with('success', 'Category deleted successfully!');
    }
}