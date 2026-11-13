<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    public function index()
    {
        $daftarPenulis = Author::orderBy('name')->get();

        return view('penulis.index', compact('daftarPenulis'));
    }

    public function create()
    {
        return view('penulis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:authors,name',
            'country' => 'nullable|string|max:100',
        ], [
            'name.required' => 'Nama penulis wajib diisi.',
            'name.max' => 'Nama penulis maksimal 100 karakter.',
            'name.unique' => 'Nama penulis sudah digunakan.',
            'country.max' => 'Negara maksimal 100 karakter.',
        ]);

        Author::create($validated);

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $penulis = Author::findOrFail($id);

        return view('penulis.edit', compact('penulis'));
    }

    public function update(Request $request, string $id)
    {
        $penulis = Author::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('authors', 'name')->ignore($penulis->id),
            ],
            'country' => 'nullable|string|max:100',
        ], [
            'name.required' => 'Nama penulis wajib diisi.',
            'name.max' => 'Nama penulis maksimal 100 karakter.',
            'name.unique' => 'Nama penulis sudah digunakan.',
            'country.max' => 'Negara maksimal 100 karakter.',
        ]);

        $penulis->update($validated);

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil diubah.');
    }

    public function destroy(string $id)
{
    $penulis = Author::findOrFail($id);

    if ($penulis->books()->exists()) {
        return redirect()->route('penulis.index')
            ->with('error', 'Penulis tidak dapat dihapus karena masih digunakan oleh buku.');
    }

    $penulis->delete();

    return redirect()->route('penulis.index')
        ->with('success', 'Penulis berhasil dihapus.');
}
}