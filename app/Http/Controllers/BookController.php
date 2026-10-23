<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private function aturan(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'price' => 'required|numeric|min:0|max:99999999',
            'published_year' => 'nullable|integer|min:1900|max:2100',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    private function pesan(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'author_name.required' => 'Nama penulis wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'publisher_id.required' => 'Penerbit wajib dipilih.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'published_year.integer' => 'Tahun terbit harus berupa angka.',
            'published_year.min' => 'Tahun terbit minimal 1900.',
            'published_year.max' => 'Tahun terbit maksimal 2100.',
            'cover.image' => 'Berkas sampul harus berupa gambar.',
            'cover.max' => 'Ukuran berkas sampul maksimal 2 MB.',
        ];
    }

    public function index()
    {
        $daftarBuku = Book::with(['category', 'publisher'])->latest()->get();
        return view('buku.index', compact('daftarBuku'));
    }

    public function create()
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('buku.create', compact('categories', 'publishers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect('/buku')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Book $buku)
    {
        return view('buku.show', compact('buku'));
    }

    public function edit(Book $buku)
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('buku.edit', compact('buku', 'categories', 'publishers'));
    }

    public function update(Request $request, Book $buku)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku->update($data);

        return redirect('/buku/' . $buku->id)->with('success', 'Data buku berhasil diperbarui!');
    }
}