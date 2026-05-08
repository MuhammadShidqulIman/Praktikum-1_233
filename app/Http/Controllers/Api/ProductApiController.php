<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    /**
     * GET: Menampilkan semua produk (Public/Protected tergantung api.php)
     */
    public function index()
    {
        try {
            $products = Product::with('kategori')->get();
            return response()->json([
                'message' => 'Berhasil mengambil semua data produk',
                'data' => $products
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error get all products', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    /**
     * POST: Menyimpan produk baru (Wajib Token)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'qty' => 'required|integer',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:kategoris,id',
            ]);

            // user_id diambil otomatis dari user yang login (Sanctum)
            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            Log::info('Menambah data produk via API', ['data' => $product]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', ['message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Gagal menambah produk',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * GET: Menampilkan detail satu produk berdasarkan ID
     */
    public function show(int $id)
    {
        try {
            $product = Product::with('kategori')->find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil detail produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    /**
     * PUT: Mengupdate data produk (Wajib Token)
     */
    public function update(Request $request, int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'qty' => 'sometimes|required|integer',
                'price' => 'sometimes|required|numeric',
                'category_id' => 'sometimes|required|exists:kategoris,id'
            ]);

            $product->update($validated);

            Log::info('Update data produk via API', ['id' => $id]);

            return response()->json([
                'message' => 'Produk berhasil diupdate!!',
                'data' => $product,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update product', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Gagal update produk'], 400);
        }
    }

    /**
     * DELETE: Menghapus produk (Wajib Token)
     */
    public function destroy(int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            $product->delete();

            Log::info('Hapus data produk via API', ['id' => $id]);

            return response()->json([
                'message' => 'Produk berhasil dihapus!!'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat hapus product', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Gagal menghapus produk'], 500);
        }
    }
}