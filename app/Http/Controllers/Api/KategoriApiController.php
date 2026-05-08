<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KategoriApiController extends Controller
{
    // GET: Mendapatkan semua kategori
    public function index()
    {
        try {
            $kategori = Kategori::all();
            return response()->json([
                'message' => 'Berhasil mengambil semua data kategori',
                'data' => $kategori
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error get all kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    // POST: Menambah kategori baru (Butuh Token)
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:kategoris,name',
            ]);

            $kategori = Kategori::create($validated);

            Log::info('Menambah data kategori', ['data' => $kategori]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan!!',
                'data' => $kategori,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Gagal menambah kategori', 'error' => $e->getMessage()], 400);
        }
    }

    // GET: Mendapatkan detail 1 kategori
    public function show(int $id)
    {
        try {
            $kategori = Kategori::with('products')->find($id);

            if (!$kategori) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Kategori retrieved successfully',
                'data' => $kategori
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil detail kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    // PUT: Mengubah data kategori (Butuh Token)
    public function update(Request $request, int $id)
    {
        try {
            $kategori = Kategori::find($id);

            if (!$kategori) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:kategoris,name,' . $id,
            ]);

            $kategori->update($validated);

            return response()->json([
                'message' => 'Kategori berhasil diupdate!!',
                'data' => $kategori,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Gagal mengupdate kategori'], 400);
        }
    }

    // DELETE: Menghapus data kategori (Butuh Token)
    public function destroy(int $id)
    {
        try {
            $kategori = Kategori::find($id);

            if (!$kategori) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $kategori->delete();

            return response()->json([
                'message' => 'Kategori berhasil dihapus!!'
            ], 200); // Atau 204 No Content
        } catch (\Throwable $e) {
            Log::error('Error saat hapus kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Gagal menghapus kategori'], 500);
        }
    }
}