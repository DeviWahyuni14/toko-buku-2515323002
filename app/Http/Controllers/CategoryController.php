<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar seluruh kategori beserta jumlah bukunya.
     */
    public function index()
    {
        return view('kategori.index', [
            'daftarKategori' => Category::withCount('books')
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Menampilkan form untuk menambah kategori baru.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Menyimpan kategori baru ke database dengan validasi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max' => 'Nama kategori maksimal 100 karakter.',
            'name.unique' => 'Nama kategori ini sudah dipakai.',
        ]);

        Category::create($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengubah data kategori.
     */
   /**
 * Menampilkan form untuk mengubah data kategori.
 */
public function edit(string $id)
{
    return view('kategori.edit', [
        'kategori' => Category::findOrFail($id),
    ]);
}
    /**
     * Memperbarui data kategori di database.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories', 'name')->ignore($kategori->id),
            ],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max' => 'Nama kategori maksimal 100 karakter.',
            'name.unique' => 'Nama kategori ini sudah dipakai.',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diubah.');
    }

    /**
     * Menghapus kategori, dengan penanganan aman jika masih terikat data buku.
     */
    public function destroy(string $id)
    {
        $kategori = Category::findOrFail($id);

        try {
            $kategori->delete();
        } catch (QueryException $e) {
            // Kode 23000 adalah kode SQL untuk pelanggaran relasi/foreign key constraint
            if ($e->getCode() !== '23000') {
                throw $e;
            }

            return redirect()->route('kategori.index')
                ->with(
                    'error',
                    'Kategori "' . $kategori->name . '" tidak bisa dihapus karena masih dipakai oleh buku.'
                );
        }

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}