<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Aturan validasi tambah dan ubah buku
    private function aturan(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'author_id' => 'nullable|integer|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'price' => 'required|integer|min:0|max:99999999',
            'published_year' => 'nullable|integer|min:1900|max:2100',
            'stock' => 'required|integer|min:0|max:100000',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    // Pesan kesalahan dalam bahasa Indonesia
    private function pesan(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'author_name.required' => 'Nama penulis wajib diisi.',
            'author_id' => 'nullable|integer|exists:authors,id',
            'category_id.required' => 'Kategori wajib dipilih.',
            'publisher_id.required' => 'Penerbit wajib dipilih.',

            'price.required' => 'Harga wajib diisi.',
            'price.integer' => 'Harga harus berupa bilangan bulat tanpa titik atau koma (contoh: 85000).',
            'price.min' => 'Harga tidak boleh negatif.',
            'price.max' => 'Harga terlalu besar (maksimal 99.999.999).',

            'published_year.integer' => 'Tahun terbit harus berupa angka bulat.',
            'published_year.min' => 'Tahun terbit minimal 1900.',
            'published_year.max' => 'Tahun terbit maksimal 2100.',

            'stock.required' => 'Stok wajib diisi (isi 0 bila habis).',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'stock.max' => 'Stok terlalu besar (maksimal 100.000).',

            'cover.image' => 'Berkas sampul harus berupa gambar.',
            'cover.max' => 'Ukuran berkas sampul maksimal 2 MB.',
            'author_id.integer' => 'Pilihan penulis tidak valid.',
            'author_id.exists' => 'Penulis yang dipilih tidak terdaftar.',
        ];
    }

    // Katalog: pencarian, filter kategori, penerbit, pagination
    public function index(Request $request)
    {
        $kataKunci = $request->query('q');
        $kategoriId = $request->query('kategori');
        $penerbitId = $request->query('penerbit');

        $daftarBuku = Book::with(['category', 'publisher'])
            ->when($kataKunci, function ($query, $kataKunci) {
                $query->where(function ($query) use ($kataKunci) {
                    $query->where('title', 'like', '%' . $kataKunci . '%')
                        ->orWhere('author_name', 'like', '%' . $kataKunci . '%');
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->where('category_id', $kategoriId);
            })
            ->when($penerbitId, function ($query, $penerbitId) {
                $query->where('publisher_id', $penerbitId);
            })
            ->latest('id')
            ->paginate(3)
            ->withQueryString();

        return view('buku.index', [
            'daftarBuku' => $daftarBuku,
            'daftarKategori' => Category::orderBy('name')->get(),
            'daftarPenerbit' => Publisher::orderBy('name')->get(),
            'kataKunci' => $kataKunci,
            'kategoriId' => $kategoriId,
            'penerbitId' => $penerbitId,
        ]);
    }

    // Form tambah buku
    public function create()
    {
    return view('buku.create', [
        'daftarKategori' => Category::orderBy('name')->get(),
        'daftarPenerbit' => Publisher::orderBy('name')->get(),
        'daftarPenulis' => Author::orderBy('name')->get(),
    ]);
}

    // Simpan buku baru
    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect('/buku')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Halaman detail buku dan rekomendasi buku serupa
    public function show(Book $buku)
    {
        $buku->load(['category', 'publisher']);

        $bukuSerupa = $buku->category
            ? $buku->category->books()
                ->whereKeyNot($buku->id)
                ->latest('id')
                ->limit(3)
                ->get()
            : collect();

        return view('buku.show', [
            'buku' => $buku,
            'bukuSerupa' => $bukuSerupa,
        ]);
    }

    // Form ubah buku
    public function edit($id)
{
    $buku = Book::findOrFail($id);

    return view('buku.edit', [
        'buku' => $buku,
        'daftarKategori' => Category::orderBy('name')->get(),
        'daftarPenerbit' => Publisher::orderBy('name')->get(),
        'daftarPenulis' => Author::orderBy('name')->get(),
    ]);
}

    // Simpan perubahan buku
   
    // Simpan perubahan buku
    public function update(Request $request, $id)
    {
        // Ambil buku berdasarkan ID
        $buku = Book::findOrFail($id);

        // Validasi data yang dikirim form
        $validated = $request->validate(
            $this->aturan(),
            $this->pesan()
        );

        // Proses cover secara terpisah
        unset($validated['cover']);

        $sampulLama = null;

        // Jika pengguna mengunggah cover baru
        if ($request->hasFile('cover')) {
            $sampulLama = $buku->cover;

            $validated['cover'] = $request
                ->file('cover')
                ->store('covers', 'public');
        }

        // Simpan perubahan termasuk author_id
        $buku->update($validated);

        // Hapus cover lama jika diganti
        if ($sampulLama) {
            Storage::disk('public')->delete($sampulLama);
        }

        // Kembali ke halaman detail buku
        return redirect()
            ->route('buku.show', $buku->id)
            ->with('success', 'Buku berhasil diperbarui.');
    }

}
